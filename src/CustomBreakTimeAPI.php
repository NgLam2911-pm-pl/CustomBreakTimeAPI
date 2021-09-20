<?php
declare(strict_types=1);

namespace NgLamVN\CustomBreakTimeAPI;

use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use RuntimeException;

class CustomBreakTimeAPI extends PluginBase{
	/** @var BaseBreakTime[] $data */
	public static array $data = [];
	/** @var bool[] */
	protected array $breaking = [];

	public function isBreaking(Player $player) : bool{
		if(!isset($this->breaking[$player->getName()])) return false;
		else return $this->breaking[$player->getName()];
	}

	public function setBreakStatus(Player $player, bool $status){
		$this->breaking[$player->getName()] = $status;
	}

	/**
	 * @throws RuntimeException
	 */
	public static function register(BaseBreakTime $baseBreakTime){
		$name = $baseBreakTime->getName();
		if(isset(self::$data[$name])) throw new RuntimeException("A BaseBreakTime config with that name aldready registered !");
		self::$data[$name] = $baseBreakTime;
	}

	public static function getBaseBreakTime(Item $item) : ?BaseBreakTime{
		$nbt = $item->getNamedTag();
		if(!$nbt->getTag("basebreaktime") == null) return null;
		$config = $nbt->getString("basebreaktime");

		return self::$data[$config] ?? null;
	}

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents(new EventHandler($this), $this);
	}
}