<?php

namespace malgn\CustomBreakTimeAPI;

use malgn\test\Test;
use pocketmine\item\Item;
use pocketmine\nbt\BigEndianNBTStream;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class CustomBreakTimeAPI extends PluginBase
{
    /** @var BaseBreakTime[] $data */
    public static $data = [];
    /** @var bool[] */
    protected $breaking = [];

    public function isBreaking(Player $player): bool
    {
        if (!isset($this->breaking[$player->getName()])) return false;
        else return $this->breaking[$player->getName()];
    }

    public function setBreakStatus(Player $player, bool $status)
    {
        $this->breaking[$player->getName()] = $status;
    }

    public static function register(BaseBreakTime $baseBreakTime)
    {
        $item = $baseBreakTime->getItem();
        self::$data[self::ItemToData($item)] = $baseBreakTime;
    }

    public static function getBaseBreakTime(Item $item): ?BaseBreakTime
    {
        if (isset(self::$data[self::ItemToData($item)]))
        {
            return self::$data[self::ItemToData($item)];
        }
        else return null;
    }

    public static function ItemToData(Item $item)
    {
        $nbt = $item->nbtSerialize();
        $edian = new BigEndianNBTStream();
        return bin2hex($edian->writeCompressed($nbt));
    }

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents(new EventHandler($this), $this);
        /*new Test();*/
    }
}