<?php

namespace App\RpgInventory;

use App\RpgCharacter\WeaponType;

class Rod extends WeaponType
{

    public function __construct()
    {
        $this->setType('ranged');
        $this->setIsDefensive(false);
        $this->setIsOffensive(true);

    }

}
