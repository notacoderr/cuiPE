<?php

namespace KL;

use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\{TextFormat, Config};
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\server\DataPacketReceiveEvent;

use pocketmine\utils\TextFormat as TF;

class CI extends PluginBase implements Listener
{   
    
    	public $formapi;
	public $pipol;
	
    public function onEnable() : void
    {

        $this->formapi = Server::getInstance()->getPluginManager()->getPlugin('FormAPI');
	    
        $this->getLogger()->info("Applying updates...");
		
        $this->particles = new particlesUI($this);
        $this->prefix = new prefixUI($this);
        $this->size = new sizeUI($this);
	$this->roles = new rolesUI($this);
        //$this->capes = new capesUI($this);
	$this->colors = new colorUI($this);

        $this->saveResource('main.yml');
        $this->settings = new Config($this->getDataFolder() . "main.yml", CONFIG::YAML);

        $this->db = new \SQLite3($this->getDataFolder() . "pcolors.db");
	$this->db->exec("CREATE TABLE IF NOT EXISTS colors (player TEXT PRIMARY KEY COLLATE NOCASE, color TEXT);");

    }
	
    public function runCMD(string $c) : void
    {
        $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $c);
    }

    public function sendMainMenu(Player $player)
    {
        $form = $this->formapi->createSimpleForm(function (Player $player, array $data) {
            if (isset($data[0])){
                $button = $data[0];
                switch ($button)
                {
		    case 0:
						$this->roles->mainForm($player);
							break;
                    case 1:	
						$this->size->mainForm($player);
							break;
                    case 2: 
						$this->prefix->mainForm($player);
							break;
                    case 3:
						$this->particles->mainForm($player);
							break;
                    case 4:
						$this->colors->mainForm($player);
							break;
                    case 5:
                                                $this->runCMD('walkp clear "' . $player->getName() . '"');
                                                         break;
                    default:
							return;
                }

				return true;
            }
        });
	    
        $form->setTitle('§l§fCosmetics');
	$form->addButton('§l§0Roles'); //data[0]
        $form->addButton('§l§0Size'); //data[1]
        $form->addButton('§l§0Custom Names'); //data[2]
	$form->addButton('§l§0Particles'); //data[3]
        $form->addButton('§l§0Chat Color'); //data[4]
        $form->addButton('§l§0Remove Particle');//data[5]
        $form->addButton('§l§0Exit'); //data6

        $form->sendToPlayer($player);
	    
    	}

	public function onCommand(CommandSender $sender, Command $cmd, String $label, array $args): bool
	{
	  	if(!$sender instanceof Player){
		  	$sender->sendMessage("Command must be run ingame!");
		 		return true;
	  	}
			switch(strtolower($cmd->getName())){
			case "cui": case "servercosmetics": case "++":
				$this->sendMainMenu($sender);
			break;
      		}
        	return true;
	}
	
	public function onChat(PlayerChatEvent $event) : void
	{
		$name = $event->getPlayer()->getName();
		$db = $this->db->query("SELECT * FROM colors WHERE player='$name';");
		$datas = $db->fetchArray(SQLITE3_ASSOC);
		$color = $datas["color"];
		$event->setMessage((string) $color . $event->getMessage() );
	}
	
	public function saveColor(Player $player, string $color ) : void
	{
		$stmt = $this->db->prepare("INSERT OR REPLACE INTO colors (player, color) VALUES (:player, :color);");   
        	$stmt->bindValue(":player", $player->getName() );
		$stmt->bindValue(":color", $color);
		$final = $stmt->execute();
	}

}
	
