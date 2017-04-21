<?php

namespace PiggyAuth\Commands;

use PiggyAuth\Main;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;

/**
 * Class PinCommand
 * @package PiggyAuth\Commands
 */
class PinCommand extends VanillaCommand
{
    /**
     * PinCommand constructor.
     * @param string $name
     * @param Main $plugin
     */
    public function __construct($name, $plugin)
    {
        parent::__construct($name, "Get your pin", "/pin");
        $this->setPermission("piggyauth.command.pin");
        $this->plugin = $plugin;
    }

    /**
     * @param CommandSender $sender
     * @param string $currentAlias
     * @param array $args
     * @return bool
     */
    public function execute(CommandSender $sender, $currentAlias, array $args)
    {
        if (!$this->testPermission($sender)) {
            return true;
        }
        if (!$sender instanceof Player) {
            $sender->sendMessage($this->plugin->languagemanager->getMessage($sender, "use-in-game"));
            return false;
        }
        $sender->sendMessage(str_replace("{pin}", $this->plugin->sessionmanager->getSession($sender)->getPin(), $this->plugin->languagemanager->getMessage($sender, "your-pin")));
        return true;
    }

}
