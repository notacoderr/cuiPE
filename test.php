<?php

namespace KL;

use KL\CI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;

class capesUI
{
    public $main;
					
	public function __construct(CI $pg) {
        	$this->main = $pg;
    	}
	
	public function mainForm(Player $player) {
        $form = $this->main->formapi->createSimpleForm(function (Player $player, array $data) {

            if (isset($data[0])){
		    
                $button = $data[0];
		$cape = $this->getCapeCustomName()[$button];
                $player->addTitle("§l§7[ ". $cape ." §7]", "§o§aYour cape has been updated");
		    
		if(strtolower($player->getSkinId()) === "standard_custom")
		{
			$this->applyMaleCape($button, $player);
		} else {
			$this->applyFemaleCape($button, $player);
		}
		    
                return true;
            }
			
        });
		
        $form->setTitle('§l§fCosmetics');
	$form->addButton("§l§fRemove Cape");
	foreach($this->getCapeCustomName() as $cape)
	{
		$form->addButton("§l§f" . $cape);
	}
		
        $form->sendToPlayer($player);
    	}
	
	private getCapeCustomName() : array
	{
		$capes = array(
                    "Enderman", //"Minecon_MineconSteveCape2016"
                    "Iron Golem", //"Minecon_MineconSteveCape2015"
                    "Piston", //"Minecon_MineconSteveCape2013"
                    "Pick Axe", //"Minecon_MineconSteveCape2012"
                    "Red Creeper" //"Minecon_MineconSteveCape2011"
		);
		return $capes;
	}

	private applyMaleCape(int $cape, Player $player) : void {
		switch($cape){
			case 1:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconSteveCape2016");
			break;
			case 2:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconSteveCape2015");
			break;
			case 3:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconSteveCape2013");
			break;
			case 4:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconSteveCape2012");
			break;
			case 5:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconSteveCape2011");
			break;
			default:
				$player->setSkin($player->getSkinData(), "Standard_CustomSlim");
		}
		$player->sendSkin($this->main->getServer()->getOnlinePlayers());
	}
	
	private applyFemaleCape(int $cape, Player $player) : void {
		switch($cape){
			case 1:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconAlexCape2016");
			break;
			case 2:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconAlexCape2015");
			break;
			case 3:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconAlexCape2013");
			break;
			case 4:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconAlexCape2012");
			break;
			case 5:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconAlexCape2011");
			break;
			default:
				$player->setSkin($player->getSkinData(), "Standard_CustomSlim");
		}
		$player->sendSkin($this->main->getServer()->getOnlinePlayers());
	}
	
}
