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
		$this->applyCape($button, $player);
		$cape = $this->getCapeCustomName()[$button];
                $player->addTitle("§l§7[ ". $cape ." §7]", "§o§aYour cape has been updated");
                return true;
            }
			
        });
		
        $form->setTitle('§l§fCosmetics');
	foreach($this->getCapeCustomName() as $cape)
	{
		$form->addButton($cape);
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

	private applyCape(int $cape, Player $player) : void {
		switch($cape){
			case 0:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconSteveCape2016");
			break;
			case 1:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconSteveCape2015");
			break;
			case 2:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconSteveCape2013");
			break;
			case 3:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconSteveCape2012");
			break;
			case 4:
			  $player->setSkin($player->getSkinData(), "Minecon_MineconSteveCape2011");
			break;
		}
	}
	
}
