<?php

namespace TN_Studios\CommandX;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info("§aPlugin enabled");
        $this->saveDefaultConfig();
        $this->reloadConfig();
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === $this->getConfig()->get("command")) {
            $message = $this->getConfig()->get("message");
            $sender->sendMessage($message);
            return true;
        }
        return false;
    }

    public function onDisable(): void {
        $this->getLogger()->info("§cPlugin disabled");
    }
}
