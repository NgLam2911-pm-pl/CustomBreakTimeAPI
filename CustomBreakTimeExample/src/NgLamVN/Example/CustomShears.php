<?php

namespace NgLamVN\Example;

use malgn\CustomBreakTimeAPI\BaseBreakTime;
use pocketmine\block\Block;

class CustomShears extends BaseBreakTime
{
    public function getBreakTime(Block $block)
    {
        switch ($block->getId())
        {
            case Block::WOOL:
            case Block::GLASS:
            case Block::LEAVES:
                return 5;
            default:
                return 999999; //Give break time handle to client.
        }
    }
}