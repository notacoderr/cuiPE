
<?php

namespace KL;

use KL\CI;
use pocketmine\Player;

class colorUI
{
  
  public $main;

	public function __construct(CI $pg) {
        $this->main = $pg;
    }

    public function mainForm(Player $player)
    {
        $form = $this->main->formapi->createSimpleForm(function (Player $player, array $data) {
        if (isset($data[0]))
          {
            $button = $data[0];
            switch ($button)
            {
                case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9:
                  $color = "&" . $button;
                  $this->main->saveColor($player, $color);
                  $player->addTitle("§l§fChat Color", "§oYour chat-color has been updated");
                break;
                case 10:
                  $color = "&a";
                  $this->main->saveColor($player, $color);
                  $player->addTitle("§l§fChat Color", "§oYour chat-color has been updated");
                break;
                case 11:
                  $color = "&b";
                  $this->main->saveColor($player, $color);
                  $player->addTitle("§l§fChat Color", "§oYour chat-color has been updated");
                break;
                case 12:
                  $color = "&c";
                  $this->main->saveColor($player, $color);
                  $player->addTitle("§l§fChat Color", "§oYour chat-color has been updated");
                break;
                case 13:
                  $color = "§d";
                  $this->main->saveColor($player, $color);
                  $player->addTitle("§l§fChat Color", "§oYour chat-color has been updated");
                break;
                case 14:
                  $color = "&e";
                  $this->main->saveColor($player, $color);
                  $player->addTitle("§l§fChat Color", "§oYour chat-color has been updated");
                break;
                case 15:
                  $color = "&f";
                  $this->main->saveColor($player, $color);
                  $player->addTitle("§l§fChat Color", "§oYour chat-color has been updated");
                break;

              default:
                 $player->sendMessage("§4§lAn ERROR has OCCURED, please report to an Admin ASAP");
              return;
            }

            return true;
          }
          
        });
        $form->setTitle('§l§fCosmetics');
        $form->addButton('§l§0Black');
        $form->addButton('§l§1Dark Blue');
        $form->addButton('§l§2Dark Green');
        $form->addButton('§l§3Dark Aqua');
        $form->addButton('§l§4Dark Red');
        $form->addButton('§l§5Dark Purple');
        $form->addButton('§l§6Gold');
        $form->addButton('§l§7Gray');
        $form->addButton('§l§8Dark Gray');
        $form->addButton('§l§9Blue');
        $form->addButton('§l§aGreen');
        $form->addButton('§l§bAqua');
        $form->addButton('§l§cRed');
        $form->addButton('§l§dLight Purple');
        $form->addButton('§l§eYellow');
        $form->addButton('§l§fWhite');
        $form->sendToPlayer($player);
    	}
 
}
