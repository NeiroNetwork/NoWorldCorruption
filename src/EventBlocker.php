<?php

declare(strict_types=1);

namespace NeiroNetwork\NoWorldCorruption;

use NeiroNetwork\NoWorldCorruption\event\PaintingBreakEvent;
use pocketmine\block\Flowable;
use pocketmine\event\block\BlockBurnEvent;
use pocketmine\event\block\BlockFormEvent;
use pocketmine\event\block\BlockGrowEvent;
use pocketmine\event\block\BlockMeltEvent;
use pocketmine\event\block\BlockSpreadEvent;
use pocketmine\event\block\BlockTeleportEvent;
use pocketmine\event\block\BlockUpdateEvent;
use pocketmine\event\block\LeavesDecayEvent;
use pocketmine\event\block\StructureGrowEvent;
use pocketmine\event\entity\EntityTrampleFarmlandEvent;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\world\World;

class EventBlocker implements Listener{

	public function __construct(private Config $config){}

	private function needsCancel(string $event, World $world) : bool{
		$settings = $this->config->get($event);
		if($settings === false){
			throw new \LogicException("Event \"$event\" not found");
		}
		if($settings["mode"] === "allowlist"){
			return !in_array($world->getFolderName(), $settings["worlds"], true);
		}elseif($settings["mode"] === "denylist"){
			return in_array($world->getFolderName(), $settings["worlds"], true);
		}
		throw new \RuntimeException("Unknown mode \"{$settings["mode"]}\"");
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockBurn(BlockBurnEvent $event){
		if($this->needsCancel("BlockBurnEvent", $event->getBlock()->getPosition()->getWorld())){
			$event->cancel();
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockForm(BlockFormEvent $event){
		if($this->needsCancel("BlockFormEvent", $event->getBlock()->getPosition()->getWorld())){
			$event->cancel();
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockGrow(BlockGrowEvent $event){
		if($this->needsCancel("BlockGrowEvent", $event->getBlock()->getPosition()->getWorld())){
			$event->cancel();
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockMelt(BlockMeltEvent $event){
		if($this->needsCancel("BlockMeltEvent", $event->getBlock()->getPosition()->getWorld())){
			$event->cancel();
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockSpread(BlockSpreadEvent $event){
		if($this->needsCancel("BlockSpreadEvent", $event->getBlock()->getPosition()->getWorld())){
			$event->cancel();
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockTeleport(BlockTeleportEvent $event){
		if($this->needsCancel("BlockTeleportEvent", $event->getBlock()->getPosition()->getWorld())){
			$event->cancel();
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onBlockUpdate(BlockUpdateEvent $event){
		$block = $event->getBlock();
		if($this->needsCancel("BlockUpdateEvent", $block->getPosition()->getWorld())){
			if(!$block instanceof Flowable && !empty($block->getCollisionBoxes())){
				$event->cancel();
			}
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onEntityTrampleFarmland(EntityTrampleFarmlandEvent $event){
		if($this->needsCancel("EntityTrampleFarmlandEvent", $event->getEntity()->getWorld())){
			$event->cancel();
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onLeavesDecay(LeavesDecayEvent $event){
		if($this->needsCancel("LeavesDecayEvent", $event->getBlock()->getPosition()->getWorld())){
			$event->cancel();
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onPaintingBreak(PaintingBreakEvent $event){
		if($this->needsCancel("PaintingBreakEvent", $event->getEntity()->getWorld())){
			if(!$event->getPlayer()->isCreative(true)){
				$event->cancel();
			}
		}
	}

	/**
	 * @priority LOWEST
	 */
	public function onStructureGrow(StructureGrowEvent $event){
		if($this->needsCancel("StructureGrowEvent", $event->getBlock()->getPosition()->getWorld())){
			if(is_null($event->getPlayer())){
				$event->cancel();
			}
		}
	}
}
