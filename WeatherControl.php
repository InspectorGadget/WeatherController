<?php

namespace RTG\LEET;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

/* Packets */
use pocketmine\network\protocol\LevelEventPacket;


class WeatherControl extends PluginBase implements Listener {
	
	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		
			if($this->getServer()->getName() === "Genisys") {
				$this->getLogger()->warning("You cant use this plugin on Genisys");
				$this->setEnabled(false);
			}
			
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $param) {
		switch(strtolower($cmd->getName())) {
			
			case "weather":
				if($sender->hasPermission("weather.control")) {
					
					if(isset($param[0])) {
						switch(strtolower($param[0])) {
							
							case "rain":
								
								$rain = new LevelEventPacket(); // Event
									foreach($this->getServer()->getOnlinePlayers() as $p) {
										
										$rain->x = $p->getX();
										$rain->y = $p->getY();
										$rain->z = $p->getZ();
										
										$pk->evid = LevelEventPacket::EVENT_START_RAIN;
										
										$p->dataPacket($pk);
										
										$sender->sendMessage("You have succssfully enabled rain");
											
									}
							
								return true;
							break;
							
							
							
							
						}
					}
					else {
						$sender->sendMessage("Usage: /weather < rain | sunny | clear >");
					}
					
				}
				else {
					$sender->sendMessage("You have no permission to use this command!");
				}
			
				return true;
			break;
		}	
	}
	
	public function onDisable() {
		
	}

}
