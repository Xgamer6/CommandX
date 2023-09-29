<?php

namespace TN_Studios\CommandXV2;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{
  
  public function onEnable(){
    $this->getLogger()->info("CommandX enabled");
  }
  
  public function onDisable(){
    $this->getLogger()->info("CommandX disabled");
  }
  
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
    if($command->getName() === "plugininfo"){
      if($sender instanceof Player){
        $sender->sendMessage("Dies ist das CommandXV2 Plugin von TN Studios");
      }else{
        $sender->sendMessage("Only for Players");
      }
      return true;
    }
    return false;
  }
}
