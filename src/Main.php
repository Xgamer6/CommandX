<?php

namespace TN_Studios\CommandX;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getLogger()->info("§aPlugin enabled");

        $this->saveResource("join.yml", false);
        $this->saveResource("leave.yml", false);

        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->getConfig()->set("joinMessage", $this->getConfig()->get("joinMessage", "Willkommen, {player}!"));
        $this->getConfig()->set("leaveMessage", $this->getConfig()->get("leaveMessage", "{player} hat den Server verlassen."));
    }

    public function onDisable(): void {
        $this->getLogger()->info("§cPlugin disabled");
    }

    public function onPlayerJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $joinMessage = str_replace("{player}", $player->getName(), $this->getConfig()->get("joinMessage"));
        $event->setJoinMessage($joinMessage);
    }

    public function onPlayerQuit(PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        $leaveMessage = str_replace("{player}", $player->getName(), $this->getConfig()->get("leaveMessage"));
        $event->setQuitMessage($leaveMessage);
    }
}
