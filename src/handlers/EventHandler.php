<?php

declare(strict_types=1);

namespace VaxPex\handlers;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\server\DataPacketSendEvent;
use VaxPex\events\PacketEvent;

class EventHandler implements Listener
{

	public function onDataPacketReceive(DataPacketReceiveEvent $event){
		$ev = new PacketEvent($event->getPacket(), $event->getOrigin());
		if($ev->isCancelled()){
			$event->cancel();
			return;
		}
		if($event->isCancelled()){
			return;
		}
		$ev->call();
	}

	public function onDataPacketSend(DataPacketSendEvent $event){
		foreach ($event->getPackets() as $packet){
			foreach ($event->getTargets() as $session){
				$ev = new PacketEvent($packet, $session);
				if($ev->isCancelled()){
					$event->cancel();
					return;
				}
				if($event->isCancelled()){
					return;
				}
				$ev->call();
			}
		}
	}
}