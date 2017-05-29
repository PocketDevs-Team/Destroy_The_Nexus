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
	
	public function Config($nombre){
	$config = new Config($this->getPlugin()->getDataFolder()."Games/".$nombre.".yml");
	return $config;
	}
	
	public function execute(CommandSender $sender, $label, array $args){
	
	if(isset($args[0])){
	$sender->sendMessage("/nexus help");
	return;
	}
	
	if(!$sender->isOp()){
	$sender->sendMessage("No tienes permiso");
	return;
	}
	
	switch($args[0]){
	
	case "help":
	$sender->sendMessage("/nexus admin [create <game>, lobby <game>, spawn <team> <game>, core <team> <game>]");
	break;
	
	case "test":
	$sender->sendMessage("test xD");
	break;
	
	case "admin":
	
	if(!isset($args[1])){
	$sender->sendMessage("/nexus help");
	return;
	
	switch($args[1]){
	case "create":
	if(!isset($args[2])){
	$sender->sendMessage("debes introducir el nombre del juego");
	return;
	}
	$name = $args[2];
	$game = Config($name);
	$world = $sender->getLevel()->getFolderName();
	$game->set("lobby", null);
	$game->save();
	$game->set("level", $world);
	$game->save();
	$game->set("red", ["spawn" => null, "core" => null]);
	$game->save();
	$game->set("yellow", ["spawn" => null, "core" => null]);
	$game->save();
	$game->set("green", ["spawn" => null, "core" => null]);
	$game->save();
	$game->set("blue" => ["spawn" => null, "core" => null]);
	$game->save();
	break;
	
	case "lobby":
	if(!isset($args[2])){
	$sender->sendMessage("debes introducir el nombre del juego");
	return;
	}
	$name = $args[2];
	$game = Config($name);
	$x = floor($sender->x);
	$y = floor($sender->y);
	$z = floor($sender->z);
	if($game->get("lobby") !== null){
	$sender->sendMessage("El lobby ya esta puesto");
	return;
	}
	$game->set("lobby", "{$x}:{$y}:{$z}");
	$game->save();
	$sender->sendMessage("Lobby puesto en las coordenadas: {$x}:{$y}:{$z}");
	break;
	
	case "spawn":
	if(!isset($args[2])){
	$sender->sendMessage("debes introducir el nombre del equipo");
	return;
	
	$team = strolower($args[2]);
	
	if($team !== "blue" || $team !== "red" || $team !== "green" || $team !== "yellow"){
	$sender->sendMessage("Equipos disponibles: red, green, blue, yellow");
	return;
	}
	
	if(!isset($args[3])){
	$sender->sendMessage("debes introducir el nombre del juego");
	return;
	}
	
	$name = $args[3];
	
	
	$game = Config($name);
	
	if($game->get($team) !== null){
	$sender->sendMessage("El spawn ya esta seleccionado");
	return;
	}
	
	$x = floor($sender->x);
	$y = floor($sender->y);
	$z = floor($sender->z);
	$game->set("$team.spawn", "{$x}:{$y}:{$z}");
	$game->save();
	$sender->sendMessage("Se ha puesto el spawn paea el equipo {$team} en las coordenadas: {$x}:{$y}:{$z}");
	break;
	
	case "core":
	break;
	}
	
	}
	break;
	
	
	
	}
	
	}

}