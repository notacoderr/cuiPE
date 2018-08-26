<?php

namespace KL;

use KL\CI;
use pocketmine\Player;

class prefixUI
{
    public $main;
	
	public function __construct(CI $pg) {
        $this->main = $pg;
    }

    public function mainForm(Player $player)
    {
        $form = $this->main->formapi->createCustomForm(function (Player $player, array $data) {
			if( isset($data[2]) )
			{
				$pref = $data[2];
				if(strlen($pref) > 0 )
				{
                    if(strlen($pref) > 15 )
                    {
                        $player->sendMessage('<•> Error! you exceed 15 chars limit.');
                    } else {
                        $this->main->getServer()->dispatchCommand($player, "setsuffix " . $pref);
                    }
				}
			}
            if( isset($data[1]) )
            {
                $nn = $data[1];
                if(strlen($nn) > 0 )
                {
                    if(strlen($nn) > 15 )
                    {
                        $player->sendMessage('<•> Error! you exceed 15 chars limit.');
                    } else {
                        if($nn == 'off')
                        {
                            $this->main->getServer()->dispatchCommand($player, "nick off");
                        } else {
                            $this->main->getServer()->dispatchCommand($player, "nick " . $nn);
                        }
                    }
                }
            }
			return true;
			
        });
        $form->setTitle('§l§fCosmetics');
        //data[0]
        $form->addLabel("§dCustom Names §r\n§fMax of 15 Characters§r\n§fIncludes spaces and specials.§r\n§fYou may Leave a space empty.");
        //$data[1]
		$form->addInput("§oPlayer Nickname | off");
        //$data[2]    
		$form->addInput("§oPlayer Suffix");
        $form->sendToPlayer($player);
    }
}