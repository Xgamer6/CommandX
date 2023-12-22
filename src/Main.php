<?php

namespace TN_Studios\CommandX;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    public function onEnable() {
        $this->getLogger()->info("§aPlugin enabled");
    }

    public function onDisable() {
        $this->getLogger()->info("§cPlugin disabled");
    }
}
