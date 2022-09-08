<?php

namespace App\RpgInventory;

use App\RpgCharacter\WeaponType;

class Sword extends WeaponType
{

    public function __construct()
    {
        $this->setType('melee');
        $this->setIsDefensive(false);
        $this->setIsOffensive(true);
    }

}
