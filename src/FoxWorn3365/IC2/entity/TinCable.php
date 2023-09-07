<?php

namespace FoxWorn3365\IC2\entity;

use pocketmine\entity\Human;
use pocketmine\entity\Skin;
use pocketmine\entity\Location;
use pocketmine\entity\EntitySizeInfo;

use FoxWorn3365\IC2\CustomBlockDictionary;

class TinCable extends Cable {
    protected string $custom = 'tin_cable';
    protected string $name = 'Tin Cable';

    public int $width = 1;
    public int $height = 0;

    public function __construct(Location $location) {
        parent::__construct($location, new Skin('Standard_Custom', CustomBlockDictionary::getSkin($this->custom), '', 'geometry.cable', CustomBlockDictionary::getGeometry($this->custom)));
    }

    public function getName() : string {
        return $this->name;
    }

    protected function getInitialSizeInfo(): EntitySizeInfo {
        return new EntitySizeInfo(1, 0.0);
    }
}