<?php

namespace malgn\CustomBreakTimeAPI;

use pocketmine\block\Block;
use pocketmine\item\Item;

abstract class BaseBreakTime
{
    /** @var string $name */
    protected $name;

    /**
     * BaseBreakTime constructor.
     * @param Item $item
     */
    public function __construct(string $name)
    {
        $this->name = $name;
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
    /**
     * @return string
     * Return name of Base break time config
     */
    public function getName(): string
    {
        return $this->name;
    }
}