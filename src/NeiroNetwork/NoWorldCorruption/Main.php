<?php

declare(strict_types=1);

namespace NeiroNetwork\NoWorldCorruption;

use pocketmine\block\Flowable;
use pocketmine\event\block\BlockBurnEvent;
use pocketmine\event\block\BlockFormEvent;
use pocketmine\event\block\BlockGrowEvent;
use pocketmine\event\block\BlockSpreadEvent;
use pocketmine\event\block\BlockTeleportEvent;
use pocketmine\event\block\BlockUpdateEvent;
use pocketmine\event\block\LeavesDecayEvent;
use pocketmine\event\block\StructureGrowEvent;
use pocketmine\event\entity\EntityTrampleFarmlandEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{

	protected function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onBlockBurn(BlockBurnEvent $event){
		$event->cancel();
	}

	public function onBlockForm(BlockFormEvent $event){
		$event->cancel();
	}

	public function onBlockGrow(BlockGrowEvent $event){
		$event->cancel();
	}

	public function onBlockSpread(BlockSpreadEvent $event){
		$event->cancel();
	}

	public function onBlockTeleport(BlockTeleportEvent $event){
		$event->cancel();
	}

	public function onBlockUpdate(BlockUpdateEvent $event){
		$block = $event->getBlock();
		if(!$block instanceof Flowable && !empty($block->getCollisionBoxes())){
			$event->cancel();
		}
	}

	public function onLeavesDecay(LeavesDecayEvent $event){
		$event->cancel();
	}

	public function onStructureGrow(StructureGrowEvent $event){
		$event->cancel();
	}

	public function onEntityTrampleFarmland(EntityTrampleFarmlandEvent $event){
		$event->cancel();
	}
}