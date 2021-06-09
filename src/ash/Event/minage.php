<?php

namespace ash\Event;

use ash\main;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\Player;

class minage implements Listener{

    public function minage(EntityDamageEvent $event){

        $db = main::minage();
        foreach($db->get('NoDamage.World') as $w)
        {
            $ListWorld[] = $w;
        }
        $entity = $event->getEntity();
        $cause = $event->getCause();

        if( $entity->getLevel() === $w){
            if($cause === EntityDamageEvent::CAUSE_LAVA || $cause === EntityDamageEvent::CAUSE_ENTITY_ATTACK || $cause === EntityDamageEvent::CAUSE_FALL || $cause === EntityDamageEvent::CAUSE_ENTITY_EXPLOSION || $cause === EntityDamageEvent::CAUSE_MAGIC || $cause === EntityDamageEvent::CAUSE_SUFFOCATION || $cause === EntityDamageEvent::CAUSE_SUICIDE){
                if($entity instanceof Player){
                    $event->setCancelled(true);
                }
            }
        }

    }
}