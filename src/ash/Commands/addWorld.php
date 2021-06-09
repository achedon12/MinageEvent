<?php

namespace ash\Commands;

use ash\main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class addWorld extends Command{

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct(
            "addWorld",
            "ajouter un monde minage",
            "/addWorld");
        $this->setPermission("use.addWorld");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            if($sender->hasPermission("use.addWorld")){
                if(!empty($args) || count($args) === 1){
                    $monde = $args[0];
                    $db = main::minage();
                    $db->setNested("NoDamage.World",$monde);
                    $db->save();
                }else{
                    $sender->sendMessage("§4/!\ §f/addWorld §cNomDuWorld");
                }
            }else{
                $sender->sendMessage("§4/!\ §fTu n'as pas la permission d'utiliser cette commande");
            }
        }else{
            $sender->sendMessage("/!\ Commande à utiliser en jeu");
        }
    }
}
