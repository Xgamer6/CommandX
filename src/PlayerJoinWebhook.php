<?php

namespace TN_Studios\CommandX;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use Cyndaron\DiscordWebhook\Webhook;

class PlayerJoinWebhook extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getLogger()->info("PlayerJoinWebhook active!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $playerName = $player->getName();

        // Deine Discord Webhook-URL hier einfügen
        $webhookUrl = "https://discord.com/api/webhooks/1187757953042874448/Rpj32z1BFhcjNmqPh_G2wrks7-EONIRdA5fdZjtM3aYTvidwlcSs0vL0CaGUF3-5wQhK";

        // Nachricht erstellen
        $message = "$playerName joined the Server!";

        // Nachricht an den Discord Webhook senden
        $webhook = new Webhook($webhookUrl);
        $webhook->setMessage($message);
        $webhook->send();
    }
}
