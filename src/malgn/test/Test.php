<?php

namespace malgn\test;

use malgn\CustomBreakTimeAPI\CustomBreakTimeAPI;
use pocketmine\item\Item;

class Test
{
    public function __construct()
    {
        $item = Item::get(Item::STICK);
        $item->setCustomName("StickShears");
        CustomBreakTimeAPI::register(new CustomPickaxe($item));
    }
}