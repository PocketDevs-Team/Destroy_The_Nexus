<?php

namespace DestroyTheNexus\DevBadBunny\BEcraft\Commands;

use pocketmine\utils\{Config, TextFormat as T};
use pocketmine\command\{CommandSender, PluginCommand};
use DestroyTheNexus\DevBadBunny\BEcraft\Main;

class NexusCommand extends PluginCommand{
	
	private $plugin;
	
	public function __construct($command, Main $plugin){
	parent::__construct($command, $plugin);
	$this->setDescription(T::YELLOW."Nexus Command");
	$this->plugin = $plugin;
	}
	
	public function getPlugin(){
	return $this->plugin;
	}
	
	public function getServer(){
	return $this->getPlugin()->getServer();
	}
	
	public function execute(CommandSender $sender, $label, array $args){
	//to-do: comandos
	}

}
