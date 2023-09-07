<?php

namespace FoxWorn3365\IC2\items;

use pocketmine\item\Stick;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;

class Placer extends Stick {
	public string $name = "Unknown";
	public ?string $block;

	public function __construct(string $block = null) {
		parent::__construct(new ItemIdentifier(ItemTypeIds::STICK));
		$this->block = $block;
	}
}