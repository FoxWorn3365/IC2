<?php

namespace FoxWorn3365\IC2;

use pocketmine\entity\Location;
use pocketmine\world\Position;
use pocketmine\player\Player;

use FoxWorn3365\IC2\entity\CustomEntity;

class Factory {
    protected object $blocks;

    public function import() : void {
        $this->blocks = CustomBlockDictionary::registerAll();
    }

    public function init() : void {
        $this->import();
    }

    public function entity(string $name, Location $location) : CustomEntity {
        $trueLocation = new Location(explode('.', $location->getX())[0] . '.5', $location->getY(), explode('.', $location->getZ())[0] . '.5', $location->getWorld(), $this->roundUpToAny((int)$location->getYaw(), 90), $this->roundUpToAny((int)$location->getYaw(), 90));
        var_dump($trueLocation);
        return new $this->blocks->{$name}($trueLocation);
    }

    public static function location(Position $position, Player $player) : Location {
        return new Location($position->getX(), $position->getY(), $position->getZ(), $player->getWorld(), $player->getLocation()->getYaw(), $player->getLocation()->getPitch());
    }

    public static function baseLocation(Location $location) : Location {
        return new Location($location->getX(), $location->getY()+1, $location->getZ(), $location->getWorld(), $location->getYaw(), $location->getPitch());
    }

    public static function roundUpToAny(int $n, int $x = 5) : int {
        return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x;
    }
    public static function center(CustomEntity $entity) : void {
        $pos = $entity->getPosition();
        $newpos = new Position(explode('.', $pos->getX())[0] . '.5', $pos->getY()-1, explode('.', $pos->getZ())[0] . '.5', $pos->getWorld());
        var_dump($newpos);
        $entity->teleport($newpos);
    }
}