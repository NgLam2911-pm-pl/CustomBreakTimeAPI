<?php

namespace malgn\CustomBreakTimeAPI;

use pocketmine\block\Block;
use pocketmine\item\Item;

abstract class BaseBreakTime
{
    /** @var Item $item */
    protected $item;

    /**
     * BaseBreakTime constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Return break time when break a block
     * @param Block $block
     * @return int
     */
    public function getBreakTime(Block $block)
    {
        return 0;
    }

    public function getItem(): Item
    {
        return $this->item;
    }
}