<?php

namespace App\RpgInventory;

use App\RpgCharacter\WeaponType;

class Shield extends WeaponType
{

    public function __construct()
    {
        $this->setType('melee');
        $this->setIsDefensive(true);
        $this->setIsOffensive(false);
    }

}
