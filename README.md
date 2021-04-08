# CustomBreakTimeAPI
Change break time of an item when break a block.
# How to use
* Make a item that can break block like efficiency I diamond pickaxe:
```php
<?php

namespace Blablabla;

use malgn\CustomBreakTimeAPI\BaseBreakTime;
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
    }
}
```
* Register:
```php
$item = Item::get(Item::STICK); //Use stick for example
$item->setCustomName("Custom Pickaxe");
CustomBreakTimeAPI::register(new TestItem($item));
```
