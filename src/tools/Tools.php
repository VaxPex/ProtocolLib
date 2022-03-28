<?php

declare(strict_types=1);

namespace VaxPex\tools;

use pocketmine\event\Listener;
use pocketmine\plugin\Plugin;
use VaxPex\events\PacketEvent;

class Tools {

	public static function executePacketEvent(callable $callback, Plugin $plugin){
		$call = new class($callback) implements Listener {
			/** @var callable */
			private $callback;

			public function __construct(callable $callback)
			{
				$this->callback = $callback;
			}

			public function onPacketEvent(PacketEvent $event)
			{
				$callback = $this->callback;
				$callback($event);
			}
		};
		$plugin->getServer()->getPluginManager()->registerEvents($call, $plugin);
	}
}
