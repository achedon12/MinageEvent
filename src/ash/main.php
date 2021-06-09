<?php

namespace ash;

use ash\Commands\addWorld;
use ash\Event\minage;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class main extends PluginBase implements Listener{

    /**@var $db Config*/
    public $db;

    private static $instance;

    public function onEnable()
    {
        $this->getLogger()->info("Plugin activé");

        $this->getServer()->getCommandMap()->registerAll('Commands',[
            new addWorld("addWorld","ajouter un monde minage","/addWorld")
        ]);

        $this->getServer()->getPluginManager()->registerEvents(new minage(),$this);

        self::$instance = $this;

        @mkdir($this->getDataFolder());
        $this->db = new Config($this->getDataFolder() . "minage.yml" . Config::YAML);

        if(!file_exists($this->getDataFolder() . "minage.yml")){
            $this->getLogger()->info("Le fichier a été créé");
            $this->saveDefaultConfig();

        }

        $db = main::minage();
        $db->setNested("NoDamage.World",0);
        $db->save();


    }
    public function onDisable()
    {
        $this->getLogger()->info("Plugin désactivé");
        $this->db->save();
    }

    public static function minage()
    {
        return new Config(main::getInstance()->getDataFolder()."minage.yml",Config::YAML);
    }

    public static function getInstance()
    {
        return self::$instance;
    }

}
