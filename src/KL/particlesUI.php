<?php

namespace KL;

use KL\CI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;

class particlesUI
{
    public $main;
    
    public $p = [
        'FLAME',
        'CRITICAL',
        'COLORFUL',
        'DUST',
        'DRIPLAVA',
        'DRIPWATER',
        'HEART',
        'EXPLODE',
        'SPELL',
        'SPORE',
        'HAPPYVILLAGER',
        'REDDUST',
        'SNOWBALL',
        'ENTITYFLAME',
        'INSTANTSPELL',
        'ENCHANTMENT',
        'PORTAL',
        'INK',
        'SLIME',
        #'LAVA',
        'WATER',
        'SMOKE'
    ];

	public function __construct(CI $pg) {
        $this->main = $pg;
    }

    public function mainForm(Player $player)
    {
        $form = $this->main->formapi->createSimpleForm(function (Player $player, array $data) {

            if (isset($data[0])){
                $button = $data[0];
                #$this->main->runCMD('particlechase set "' . $player->getName() . '" ' . $this->p[ $button ]); #particlechase
                $this->main->runCMD('walkp set ' .strtolower( $this->p[ $button ] ). ' "'. $player->getName() . '" '); #walkingparticles
                $player->addTitle("§l§fParticles", "§o§fYour particle has been updated into §c" . $this->p[ $button ]);
                return true;
            }

        });

        $form->setTitle('§l§fCosmetics');
        foreach($this->p as $ps)
        {
            $form->addButton("§l".$ps); //data[0]
        }
        $form->sendToPlayer($player);
    }

}