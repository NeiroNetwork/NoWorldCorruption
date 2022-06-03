<?php

declare(strict_types=1);

namespace NeiroNetwork\NoWorldCorruption\event;

use pocketmine\entity\object\Painting;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\entity\EntityEvent;
use pocketmine\player\Player;

class PaintingBreakEvent extends EntityEvent implements Cancellable{
	use CancellableTrait;

	public function __construct(Painting $painting, private Player $player){
		$this->entity = $painting;
	}

	public function getPlayer() : Player{
		return $this->player;
	}
}
