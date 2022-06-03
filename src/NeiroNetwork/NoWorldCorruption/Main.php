<?php

declare(strict_types=1);

namespace NeiroNetwork\NoWorldCorruption;

use pocketmine\block\Flowable;
use pocketmine\entity\object\Painting;
use pocketmine\event\block\BlockBurnEvent;
use pocketmine\event\block\BlockFormEvent;
use pocketmine\event\block\BlockGrowEvent;
use pocketmine\event\block\BlockMeltEvent;
use pocketmine\event\block\BlockSpreadEvent;
use pocketmine\event\block\BlockTeleportEvent;
use pocketmine\event\block\BlockUpdateEvent;
use pocketmine\event\block\LeavesDecayEvent;
use pocketmine\event\block\StructureGrowEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityTrampleFarmlandEvent;
use pocketmine\event\Listener;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{

	protected function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockBurn(BlockBurnEvent $event){
		$event->cancel();
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockForm(BlockFormEvent $event){
		$event->cancel();
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockGrow(BlockGrowEvent $event){
		$event->cancel();
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockMelt(BlockMeltEvent $event){
		$event->cancel();
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockSpread(BlockSpreadEvent $event){
		$event->cancel();
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockTeleport(BlockTeleportEvent $event){
		$event->cancel();
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockUpdate(BlockUpdateEvent $event){
		$block = $event->getBlock();
		if(!$block instanceof Flowable && !empty($block->getCollisionBoxes())){
			$event->cancel();
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onEntityTrampleFarmland(EntityTrampleFarmlandEvent $event){
		$event->cancel();
	}

	/**
	 * @priority LOWEST
	 */
	public function onLeavesDecay(LeavesDecayEvent $event){
		$event->cancel();
	}

	/**
	 * @priority LOWEST
	 */
	public function onPaintingBreak(EntityDamageByEntityEvent $event){
		$entity = $event->getEntity();
		$damager = $event->getDamager();
		if($entity instanceof Painting && $damager instanceof Player){
			if($damager->getGamemode() !== GameMode::CREATIVE()){
				$event->cancel();
			}
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onStructureGrow(StructureGrowEvent $event){
		if($event->getPlayer() === null) $event->cancel();
	}
}
