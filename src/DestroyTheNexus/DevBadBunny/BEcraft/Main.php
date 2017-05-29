<?php
namespace DestroyTheNexus\DevBadBunny\BEcraft;

use pocketmine\Server;
use pocketmine\utils\TextFormat as T;
use pocketmine\plugin\PluginBase;
use DestroyTheNexus\DevBadBunny\BEcraft\Commands\NexusCommand;

class Main extends PluginBase{
	
	public $prefix = "";
	
	public function onEnable(){
	$this->getLogger()->info($this->getPrefix().T::GREEN."Destruye el nexus se ha cargado correctamente!");
	$this->Config();
	$this->RegisterCommands();
	}
	
	public function onDisable(){
	$this->getLogger()->notice(T::RED."El plugin ha tenido un error");
	}
	
	public function onLoad(){
	$this->getLogger()->info(T::YELLOW."El plugin se esta cargando");
	}
	
	public function Config(){
	if(!is_dir($this->getDataFolder())){
	$this->getLogger()->info($this->getPrefix().T::GOLD."No se ha encontrado la carpeta del juego, creando nueva...");
	@mkdir($this->getDataFolder());
	@mkdir($this->getDataFolder()."Games/");
	}
	}
	
	public function getPrefix(){
	return $this->prefix;
	}
	
	public function RegisterCommands(){
	$this->getServer()->getCommandMap()->register("nexus", new NexusCommand("nexus", $this));
	}
	
}