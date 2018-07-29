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
	
	public function mainForm(Player $player)
    {
        $form = $this->main->formapi->createCustomForm(function (Player $player, array $data) {

            if (isset($data[0])){
                $button = $data[0];
				
				$cape = $this->getCapeActual[ $button ]; //selecting the capes
				
				$player->setSkin($player->getSkinData(), $cape); //setting the skin + cape
				
                $player->addTitle("§l§7[ ". $cape ." §7]", "§o§aYour cape has been updated");
                return true;
            }
			
        });
		
        $form->setTitle('§l§fCosmetics');
		$form->addDropdown("Please select a Cape:", $this->getCapeCustomName, 0); //data 0
        $form->sendToPlayer($player);
    }
	
	private getCapeCustomName() : array {
		$tempCapes = array(
                    "PickAxe Cape", //SteveCape2016
                    "ProbsEnderman Cape", //"Minecon_MineconSteveCape2015", HELP MEEEH IDK TF ARE THESE
                    "Mojang?", //"Minecon_MineconSteveCape2013",
                    "Minecon_MineconSteveCape2012", //NAMESC 
                    "Minecon_MineconSteveCape2011"
					);
					
	}
	
	private getCapeActual(int $whatever) : string {
		$trueCapes = array(
                    "Minecon_MineconSteveCape2016",
                    "Minecon_MineconSteveCape2015",
                    "Minecon_MineconSteveCape2013",
                    "Minecon_MineconSteveCape2011"
					);
					
		return $trueCapes [ $whatever ];
	}	
	
}
