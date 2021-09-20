<?php
declare(strict_types=1);

namespace NgLamVN\CustomBreakTimeAPI;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\PlayerActionPacket;
use pocketmine\player\GameMode;

class EventHandler implements Listener{
	/** @var CustomBreakTimeAPI $api */
	protected CustomBreakTimeAPI $api;
	/** @var BreakTask[] */
	protected array $task = [];

	public function __construct(CustomBreakTimeAPI $api){
		$this->api = $api;
	}

	public function getAPI() : CustomBreakTimeAPI{
		return $this->api;
	}

	/**
	 * @param DataPacketReceiveEvent $event
	 * @priority LOWEST
	 * @handleCancelled FALSE
	 */
	public function onRecieve(DataPacketReceiveEvent $event) : void{
		$player = $event->getOrigin()->getPlayer();
		if($player->getGamemode() !== GameMode::SURVIVAL()){
			return;
		}
		$packet = $event->getPacket();
		if($packet instanceof PlayerActionPacket){
			switch($packet->action){
				case PlayerActionPacket::ACTION_START_BREAK:
					$item = $player->getInventory()->getItemInHand();
					$basetime = CustomBreakTimeAPI::getBaseBreakTime($item);
					if($basetime == null) return;
					$pos = new Vector3($packet->x, $packet->y, $packet->z);
					$block = $player->getWorld()->getBlock($pos);
					$time = $basetime->reCaculateBreakTime($block, $item, $player);
					$this->getAPI()->setBreakStatus($player, true);
					$this->task[$player->getName()] = new BreakTask($player, $pos, $this->getAPI());
					$this->getAPI()->getScheduler()->scheduleDelayedTask($this->task[$player->getName()], $time);
					break;
				case PlayerActionPacket::ACTION_ABORT_BREAK:
				case PlayerActionPacket::ACTION_STOP_BREAK:
					$this->getAPI()->setBreakStatus($player, false);
					if(isset($this->task[$player->getName()]))
						$this->task[$player->getName()]->cancel();
					break;
			}
		}
	}

	/**
	 * @param PlayerInteractEvent $event
	 * @priority LOWEST
	 * @handleCancelled FALSE
	 */
	public function onInteract(PlayerInteractEvent $event) : void{
		if($event->isCancelled()){
			$this->getAPI()->setBreakStatus($event->getPlayer(), false);
		}
	}
}