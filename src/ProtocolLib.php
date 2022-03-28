<?php

declare(strict_types=1);

namespace VaxPex;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use VaxPex\handlers\EventHandler;

class ProtocolLib extends PluginBase {
	use SingletonTrait;

	protected function onLoad(): void
	{
		self::setInstance($this);
	}

	protected function onEnable(): void
	{
		$this->getServer()->getPluginManager()->registerEvents(new EventHandler, $this);
	}
}