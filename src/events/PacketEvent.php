<?php

declare(strict_types=1);

namespace VaxPex\events;

use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\Event;
use pocketmine\network\mcpe\JwtUtils;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\network\mcpe\protocol\Packet;
use pocketmine\network\mcpe\protocol\types\login\ClientData;
use pocketmine\network\PacketHandlingException;

class PacketEvent extends Event implements Cancellable {
	use CancellableTrait;

	/** @var Packet */
	private $packet;
	/** @var NetworkSession */
	private $origin;

	public function __construct(Packet $packet, NetworkSession $origin){
		$this->packet = $packet;
		$this->origin = $origin;
	}

	/**
	 * @return Packet
	 */
	public function getPacket(): Packet
	{
		return $this->packet;
	}

	/**
	 * @return NetworkSession
	 */
	public function getOrigin(): NetworkSession
	{
		return $this->origin;
	}

	public function toString(): string
	{
		$eo = $this->getOrigin()->getPlayerInfo() !== null ? $this->getOrigin()->getPlayerInfo()->getUsername() : $this->getOrigin()->getDisplayName();
		if($this->getPacket() instanceof LoginPacket){
			[, $clientDataClaims, ] = JwtUtils::parse($this->getPacket()->clientDataJwt);
			$name = $clientDataClaims["ThirdPartyName"];
			return "[PacketEvent:{$this->getPacket()->getName()}:{$name}]";
		}
		return "[PacketEvent:{$this->getPacket()->getName()}:{$eo}]";
	}
}
