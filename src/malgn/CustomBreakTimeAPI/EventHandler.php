<?php

namespace NgLamVN\CustomBreakTimeAPI;

use malgn\CustomBreakTimeAPI\CustomBreakTimeAPI;
use pocketmine\event\Listener;

class EventHandler implements Listener
{
    /** @var CustomBreakTimeAPI $api */
    public $api;

    public function __construct(CustomBreakTimeAPI $API)
    {
        $this->api = $API;
    }

    public function getAPI(): CustomBreakTimeAPI
    {
        return $this->api;
    }

    public function onRecieve (DataPacketReceiveEvent $event)
    {
        $player = $event->getPlayer();
        $packet = $event->getPacket();

        if ($packet instanceof PlayerActionPacket)
        {
            switch ($packet->action)
            {
                case PlayerActionPacket::ACTION_START_BREAK:
                    break;
                case PlayerActionPacket::ACTION_ABORT_BREAK:
                case PlayerActionPacket::ACTION_STOP_BREAK:
                    break;
            }
        }
    }
}