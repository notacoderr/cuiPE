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
						if($player->hasPermission('c.size.ant'))
						{
							$this->resize($player, (float) 0.1111); //ant
							break;
						} else {
							$this->noPerm($player);
							break;
						}

					case 1:
						if($player->hasPermission('c.size.fairy'))
						{
							$this->resize($player, (float) 0.25); //fairy
							break;
						} else {
							$this->noPerm($player);
							break;
						}

                   	case 2:
						$this->resize($player, (float) 0.45511); //baby
							break;
                    case 3:
						$this->resize($player, (float) 0.6331); //kid
							break;
					case 4:
						$this->resize($player, (float) 1.0); //normal
							break;

					case 5:
						if($player->hasPermission('c.size.giant'))
						{
							$this->resize($player, (float) 1.5111);//giant
								break;
						} else {
							$this->noPerm($player);
								break;
						}

					case 6:
						if($player->hasPermission('c.size.titan'))
						{
							$this->resize($player, (float) 3.0322);//titan
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
        $form->setTitle('§l§dKawaii §fCosmetics');
		$form->addButton('§lAnt§r [VIP]', 1, $this->main->settings->getNested('size.ant'));
		$form->addButton('§lFairy§r [VIP/Patron]', 1, $this->main->settings->getNested('size.fairy'));
		$form->addButton('§lBaby', 1, $this->main->settings->getNested('size.baby'));
		$form->addButton('§lKid', 1, $this->main->settings->getNested('size.kid'));
		$form->addButton('§lNormal', 1, $this->main->settings->getNested('size.normal'));
		$form->addButton('§lGiant§r [VIP/Patron]', 1, $this->main->settings->getNested('size.giant'));
		$form->addButton('§lTitan§r [VIP]', 1, $this->main->settings->getNested('size.titan'));
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