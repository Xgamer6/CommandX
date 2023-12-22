<?php

namespace TN_Studios\CommandX;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class MeinPlugin extends PluginBase {

    public function onEnable() {
        $this->getLogger()->info("CommandX enabled");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "test") {
            $sender->sendMessage("Test");
            return true;
        }
        return false;
    }

    public function onDisable() {
        $this->getLogger()->info("CommandX disabled");
    }
}
