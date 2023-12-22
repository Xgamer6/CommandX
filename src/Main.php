<?php

namespace TN_Studios\CommandX;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\form\Form;
use pocketmine\form\SimpleForm;
use pocketmine\form\element\Input;

class Main extends PluginBase implements Listener {

    /** @var Config */
    private $config;

    public function onEnable(): void {
        $this->getLogger()->info("§aPlugin enabled!");

        $this->saveResource("config.yml", false);

        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public function onDisable(): void {
        $this->getLogger()->info("§cPlugin disabled!");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "cmdx-form") {
            if ($sender instanceof Player) {
                $title = $this->config->get("title", "Standardtitel");
                $description = $this->config->get("description", "Standardbeschreibung");
                $buttonText = $this->config->get("first_button_text", "Standard-Button");
                $buttonCommand = $this->config->get("first_button_command", "/standard-command");

                $this->openCustomForm($sender, $title, $description, $buttonText, $buttonCommand);
                return true;
            } else {
                $sender->sendMessage("Dieser Befehl kann nur von einem Spieler verwendet werden.");
                return false;
            }
        }
        return false;
    }

    private function openCustomForm(Player $player, string $title, string $description, string $buttonText, string $buttonCommand) {
        $form = new SimpleForm(function (Player $player, $data) use ($buttonCommand) {
            if ($data === null) {
                return;
            }
            
            // Hier kannst du den ausgewählten Button weiterverarbeiten
            if ($data === 0) {
                // Der erste Button wurde ausgewählt, führe den Befehl aus
                $player->chat($buttonCommand);
            }
        });

        $form->setTitle($title);
        $form->setContent($description);
        $form->addButton($buttonText);

        $player->sendForm($form);
    }
}
