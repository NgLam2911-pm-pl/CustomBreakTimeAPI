<?php

namespace malgn\test;

use malgn\CustomBreakTimeAPI\BaseBreakTime;
use pocketmine\block\Block;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;

class CustomPickaxe extends BaseBreakTime
{
    public function getBreakTime(Block $block)
    {
        if ($block->getId() == Block::WOOL) return 2;
        else return 60;
    }
}
