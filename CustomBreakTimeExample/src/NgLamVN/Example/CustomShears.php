<?php

namespace NgLamVN\Example;

use malgn\CustomBreakTimeAPI\BaseBreakTime;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\Player;

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

    public function onBreak(Vector3 $pos, Player $player, Item $item)
    {
        $item = Item::get(Item::SHEARS); // Make block drop like use shears !
        parent::onBreak($pos, $player, $item);
    }
}