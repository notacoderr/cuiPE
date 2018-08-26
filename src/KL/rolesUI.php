<?php

namespace KL;

use KL\CI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;

class rolesUI
{
    public $main;

	public function __construct(CI $pg) {
        $this->main = $pg;
    }
	
	public function mainForm(Player $player)
    {
        $form = $this->main->formapi->createCustomForm(function (Player $player, array $data) {

            if (isset($data[1])){
                $button = $data[1];
				#$playername = '"'.$player->getName().'"';
				$role = $this->main->settings->getNested('roles')[ $button ];
				switch($data[2])
				{
					case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9:
						$role = "§" . $data[2] . $role;
					break;
					case 10:
						$role = "§e" . $role;
					break;
					case 11:
						$role = "§a" . $role;
					break;
					case 12:
						$role = "§b" . $role;
					break;
					case 13:
						$role = "§c" . $role;
					break;
					case 14:
						$role = "§d" . $role;
					break;
				}
                $this->main->runCMD('setprefix "' .$player->getName() . '" ' . $role);
                $player->addTitle("§l§7[ ". $role ." §7]", "§o§aYour role has been updated");
                return true;
            }

        });

        $form->setTitle('§l§fCosmetics');
		$form->addLabel("Color palette: §00 §11 §22 §33 §44 §55 §66 §77 §88 §99 §e10 §a11 §b12 §c13 §d14§r \n\n\n");//data 0
		$form->addDropdown("Pick your role:", $this->main->settings->getNested('roles'), 0); //data 1
		$form->addSlider("Select Color", 0, 14, -1, 0); //data 2
        $form->sendToPlayer($player);
    }
}