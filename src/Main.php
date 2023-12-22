<?php

namespace TN_Studios\CommandX;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info("§aPlugin enabled");
    }

    public function onDisable(): void {
        $this->getLogger()->info("§cPlugin disabled");
    }
}
