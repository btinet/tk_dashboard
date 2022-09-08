<?php

namespace App\Controller;

use App\Entity\Dwarf;
use App\Entity\Mage;
use App\RpgCharacter\AbstractCharacter;
use App\RpgInventory\Rod;
use App\RpgInventory\Shield;
use App\RpgInventory\Sword;

class CharController
{

    public function setChar()
    {
        $dwarf = new Dwarf();

        $dwarf->setHp(100);
        $dwarf->setMp(0);
        $dwarf->setDp(50);
        $dwarf->setExp(0);
        $dwarf->setIsActive(true);
        $dwarf->setIsBlocked(false);
        $dwarf->configureGear([
            'mainWeapon' => new Sword(),
            'sideWeapon' => new Shield(),
        ]);
        $dwarf->setName('Rumpelstilzien');

        $mage = new Mage();
        $mage->setHp(100);
        $mage->setMp(100);
        $mage->setDp(50);
        $mage->setExp(0);
        $mage->setIsActive(true);
        $mage->setIsBlocked(false);
        $mage->configureGear([
            'mainWeapon' => new Rod(),
        ]);
        $mage->setName('Harry Potter');

        echo '<pre><code>';
        print_r($dwarf);
        print_r($mage);
        echo '</code></pre>';
    }

    public function doHit( AbstractCharacter $sender, AbstractCharacter $receiver)
    {
        $senderStrength = $sender->getGear()->getMainWeapon()->getStrength();
        $receiver->setHp($receiver->getHp() - $senderStrength);
    }

}