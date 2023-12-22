<?php

namespace TN_Studios\CommandX;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\network\mcpe\protocol\AddPlayerPacket;
use pocketmine\network\mcpe\protocol\PlayerListPacket;
use pocketmine\Player;
use pocketmine\entity\Entity;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getLogger()->info("§aPlugin enabled");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDisable() {
        $this->getLogger()->info("§cPlugin disabled");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "cmdx-spawn") {
            if ($sender instanceof Player) {
                $fakePlayerName = "FakePlayer"; // Hier kannst du den Namen des Fake-Players ändern
                $this->spawnFakePlayer($sender, $fakePlayerName);
                $sender->sendMessage("Ein Fake-Player wurde gespawnt!");
                return true;
            } else {
                $sender->sendMessage("Dieser Befehl kann nur von einem Spieler verwendet werden.");
                return false;
            }
        }
        return false;
    }

    private function spawnFakePlayer(Player $player, string $fakePlayerName) {
        $skin = $player->getSkin();
        $displayName = $player->getDisplayName();
        $uuid = $player->getUniqueId();

        $addPlayerPacket = new AddPlayerPacket();
        $addPlayerPacket->entityRuntimeId = Player::NETWORK_ID + $player->getId();
        $addPlayerPacket->uuid = $uuid;
        $addPlayerPacket->username = $fakePlayerName;
        $addPlayerPacket->x = $player->getX();
        $addPlayerPacket->y = $player->getY();
        $addPlayerPacket->z = $player->getZ();
        $addPlayerPacket->speedX = 0;
        $addPlayerPacket->speedY = 0;
        $addPlayerPacket->speedZ = 0;
        $addPlayerPacket->yaw = $player->getYaw();
        $addPlayerPacket->pitch = $player->getPitch();
        $addPlayerPacket->item = 0;
        $addPlayerPacket->metadata = $player->getDataPropertyManager()->getAll();
        $addPlayerPacket->flags = (
            1 << Entity::DATA_FLAG_INVISIBLE |
            1 << Entity::DATA_FLAG_CAN_SHOW_NAMETAG |
            1 << Entity::DATA_FLAG_ALWAYS_SHOW_NAMETAG
        );
        $addPlayerPacket->username = $fakePlayerName;
        $addPlayerPacket->skin = $skin;

        $player->dataPacket($addPlayerPacket);

        $playerListPacket = new PlayerListPacket();
        $playerListPacket->type = PlayerListPacket::TYPE_ADD;
        $playerListPacket->entries[] = [
            "uuid" => $uuid,
            "entityUniqueId" => $addPlayerPacket->entityRuntimeId,
            "entityRuntimeId" => $addPlayerPacket->entityRuntimeId,
            "username" => $fakePlayerName,
        ];

        $player->dataPacket($playerListPacket);
    }
}
