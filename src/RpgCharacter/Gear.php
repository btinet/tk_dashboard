<?php

namespace App\RpgCharacter;

class Gear
{

    protected ?WeaponType $mainWeapon;

    protected ?WeaponType $sideWeapon;


    public function getMainWeapon(): ?WeaponType
    {
        return $this->mainWeapon;
    }


    public function setMainWeapon($mainWeapon): void
    {
        $this->mainWeapon = $mainWeapon;
    }


    public function getSideWeapon(): ?WeaponType
    {
        return $this->sideWeapon;
    }


    public function setSideWeapon($sideWeapon): void
    {
        $this->sideWeapon = $sideWeapon;
    }

}