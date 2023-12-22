<?php

namespace TN_Studios\CommandX;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

    /** @var Config */
    private $joinConfig;
    /** @var Config */
    private $leaveConfig;

    public function onEnable(): void {
        $this->getLogger()->info("§aPlugin enabled");

        $this->saveResource("join.yml", false);
        $this->saveResource("leave.yml", false);

        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->joinConfig = new Config($this->getDataFolder() . "join.yml", Config::YAML);
        $this->leaveConfig = new Config($this->getDataFolder() . "leave.yml", Config::YAML);
    }

    public function onDisable() {
        $this->getLogger()->info("§cPlugin disabled");
    }

    public function onPlayerJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $joinMessage = $this->joinConfig->get("joinMessage", "Willkommen, {player}!");
        $joinMessage = str_replace("{player}", $player->getName(), $joinMessage);
        $event->setJoinMessage($joinMessage);
    }

    public function onPlayerQuit(PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        $leaveMessage = $this->leaveConfig->get("leaveMessage", "{player} hat den Server verlassen.");
        $leaveMessage = str_replace("{player}", $player->getName(), $leaveMessage);
        $event->setQuitMessage($leaveMessage);
    }
}
