<?php

namespace Blablabla;

use malgn\CustomBreakTimeAPI\BaseBreakTime;
use malgn\CustomBreakTimeAPI\CustomBreakTimeAPI;
use pocketmine\block\Block;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;

class TestItem extends BaseBreakTime
{
    public function getBreakTime(Block $block)
    {
        $item = Item::get(Item::DIAMOND_PICKAXE);
        $ench = Enchantment::getEnchantment(Enchantment::EFFICIENCY)
        $item->addEnchantment(new EnchantmentInstance($ench, 1));
        return $block->getBreakTime($item);
        $item = Item::get(Item::STICK);
        $item->setCustomName("Custom Pickaxe");
        CustomBreakTimeAPI::register(new TestItem($item));
    }
}