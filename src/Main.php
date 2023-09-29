```php
<?php

namespace TN_Studios\CommandXV2;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    public function onEnable() {
        // Plugin startup logic
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "pluginfo") { // Change "testcommand" to the desired command name
            $sender->sendMessage("This is a test message."); // Customize the message here
            return true;
        }
        return false;
    }
}
```
