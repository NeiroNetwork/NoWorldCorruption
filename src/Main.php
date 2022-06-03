<?php

declare(strict_types=1);

namespace NeiroNetwork\NoWorldCorruption;

use NeiroNetwork\NoWorldCorruption\event\PaintingBreakEvent;
use pocketmine\entity\object\Painting;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{

	protected function onEnable() : void{
		$manager = $this->getServer()->getPluginManager();
		$manager->registerEvents($this, $this);
		$manager->registerEvents(new EventBlocker($this->getConfig()), $this);
	}

	/**
	 * @priority LOWEST
	 */
	public function onEntityDamageByEntity(EntityDamageByEntityEvent $event) : void{
		$entity = $event->getEntity();
		$damager = $event->getDamager();
		if($entity instanceof Painting && $damager instanceof Player){
			$ev = new PaintingBreakEvent($entity, $damager);
			$ev->call();
			if($ev->isCancelled()){
				$event->cancel();
			}
		}
	}
}
