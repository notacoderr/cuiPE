<?php

namespace KL;

use KL\CI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\entity\Entity;

class sizeUI
{
    public $main;

	public function __construct(CI $pg) {
        $this->main = $pg;
    }

    public function mainForm(Player $player)
    {
        $form = $this->main->formapi->createSimpleForm(function (Player $player, array $data) {
            if (isset($data[0])){
                $button = $data[0];
                switch ($button)
                {
					case 0:
						if($player->hasPermission('sakura.vip'))
						{
							$this->resize($player, (float) 0.123); //ant
							break;
						} else {
							$this->noPerm($player);
							break;
						}

					case 1:
						if($player->hasPermission('sakura.vip'))
						{
							$this->resize($player, (float) 0.2765); //fairy
							break;
						} else {
							$this->noPerm($player);
							break;
						}
					case 2:
						if($player->hasPermission('sakura.vip'))
						{
							$this->resize($player, (float) 0.3701); //tiny
							break;
						} else {
							$this->noPerm($player);
							break;
						}

                   			case 3:
						$this->resize($player, (float) 0.4551); //baby
							break;
                    			case 4:
						$this->resize($player, (float) 0.6331); //kid
							break;
					case 5:
						$this->resize($player, (float) 0.8912); //teen
							break;
					case 6:
						$this->resize($player, (float) 1.0); //normal
							break;

					case 7:
						if($player->hasPermission('sakura.vip'))
						{
							$this->resize($player, (float) 1.5111);//giant
								break;
						} else {
							$this->noPerm($player);
								break;
						}

					case 8:
						if($player->hasPermission('sakura.vip'))
						{
							$this->resize($player, (float) 3.422);//tera
								break;
						} else {
							$this->noPerm($player);
								break;
						}
					case 9:
						if($player->hasPermission('sakura.vip'))
						{
							$this->resize($player, (float) 5.1322);//titan
								break;
						} else {
							$this->noPerm($player);
								break;
						}
							
                    default:
                        $player->sendMessage("§4§lAn ERROR has OCCURED, please report to an Admin ASAP");
							return;
                }

				return true;
            }
        });
        $form->setTitle('§l§fCosmetics');
		$form->addButton('§lAnt§r [VIP & up]'); //0
		$form->addButton('§lFairy§r [VIP & up]'); //1
		$form->addButton('§lTiny§r [VIP & up]'); //2
		$form->addButton('§lBaby'); //3
		$form->addButton('§lKid'); //4
	    	$form->addButton('§lTeen'); //5
	    	$form->addButton('§lNormal'); //6
		$form->addButton('§lGiant§r [VIP & up]'); //7
	    	$form->addButton('§lTera§r [VIP & up]'); //8
		$form->addButton('§lTitan§r [VIP & up]'); //9
        $form->sendToPlayer($player);
    	}
    
	private function noPerm($player)
    	{
    		$player->sendMessage('<•> §cI apologise, it seems that you have no permission.');
    	}

	private function resize(Player $player, float $scale) : void
	{
		$player->getDataPropertyManager()->setFloat(Entity::DATA_SCALE, $scale);
		$player->sendData($player->getViewers());
		$player->addTitle("§l§fCosmetics", "§o§cYour size has been updated");
	}

}
