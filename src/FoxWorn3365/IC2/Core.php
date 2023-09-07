<?php

/*
 * IC2 for PocketMine-MP
 * Add the IC2 mod to your PMMP server.
 * 
 * Copyright (C) 2023-now FoxWorn3365
 * Relased under GNU General Public License v3.0 (https://github.com/FoxWorn3365/Shopkeepers/blob/main/LICENSE)
 * You can find the license file in the root folder of the project inside the LICENSE file!
 * If not, see https://www.gnu.org/licenses/
 * 
 * Useful links:
 * - GitHub: https://github.com/FoxWorn3365/IC2
 * - Contribution guidelines: https://github.com/FoxWorn3365/IC2#contributing
 * - Author GitHub: https://github.com/FoxWorn3365
 * 
 * Current file: /Core.php
 * Description: The core of the plugin, manage all events and commands
 */

declare(strict_types=1);

namespace FoxWorn3365\IC2;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\item\VanillaItems;
use pocketmine\item\Item;
use pocketmine\command\Command;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Server;
use pocketmine\level\Position;
use pocketmine\entity\Entity;
use pocketmine\block\RuntimeBlockStateRegistry;
use customiesdevs\customies\block\CustomiesBlockFactory;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\Block;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\BlockTypeIds;
use pocketmine\item\StringToItemParser;

use customiesdevs\customies\item\CustomiesItemFactory;

// Events
use pocketmine\event\player\PlayerJoinEvent;

// Use
use pocketmine\network\mcpe\protocol\ResourcePackStackPacket;

// Blocks
use FoxWorn3365\IC2\block\CoalGenerator;
use FoxWorn3365\IC2\entity\TinCable;

// NBT
use pocketmine\nbt\tag\CompoundTag;

// Packet
use pocketmine\network\mcpe\protocol\ItemComponentPacket;
use pocketmine\network\mcpe\protocol\types\ItemComponentPacketEntry;
use pocketmine\network\mcpe\protocol\types\CacheableNbt;

// Events
use pocketmine\event\player\PlayerItemUseEvent;

// Items
use pocketmine\item\Stick;

class Core extends PluginBase implements Listener {
    protected object $entity;
    protected Factory $factory;

    protected const NOT_PERM_MSG = "§cSorry but you don't have permissions to use this command!\nPlease contact your server administrator";
    public const AUTHOR = "FoxWorn3365";
    public const VERSION = "0.2";

    public function onLoad() : void {
        $this->entity = new \stdClass;
    }

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        
        $this->factory = new Factory();
        $this->factory->init();
    }

    public function onPlayerJoin(PlayerJoinEvent $event) : void {
        $item = VanillaItems::STICK();
        $item->setLore(["tin_cable"]);
        $event->getPlayer()->getInventory()->addItem($item);
    }

    public function onPlayerItemUse(PlayerItemUseEvent $event) : void {
        if ($event->getItem() instanceof Stick && $event->getItem()->getLore()[0] !== null) {
            //$entity = $this->factory->entity($event->getItem()->getLore()[0], Factory::location($event->getPlayer()->getWorld()->getBlock($event->getDirectionVector())->getPosition(), $event->getPlayer()));
            $entity = $this->factory->entity($event->getItem()->getLore()[0], Factory::location($event->getPlayer()->getPosition(), $event->getPlayer()));
            var_dump($entity::class);
            $entity->spawnTo($event->getPlayer());
            Factory::center($entity);
        }
    }
}