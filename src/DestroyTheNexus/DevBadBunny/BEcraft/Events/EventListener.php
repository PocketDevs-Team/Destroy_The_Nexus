<?php

namespace DestroyTheNexus\DevBadBunny\BEcraft\Commands;

use pocketmine\event\Listener;

class EventListener implements Listener{
	
	private $plugin;
	
	public function __construct(Main $plugin){
	$this->plugin = $plugin;
	}
	
	public function getServer(){
	return $this->getPlugin()->getServer();
	}
	
	public function getPlugin(){
	return $this->plugin;
	}
	
}