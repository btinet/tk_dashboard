<?php

namespace App\RpgCharacter;

abstract class AbstractCharacter
{

    protected int $id;

    protected string $name;

    protected string $slug;

    protected int $hp;

    protected int $mp;

    protected int $dp;

    protected int $exp;

    protected int $isActive;

    protected int $isBlocked;

    protected Gear $gear;

    public function __construct()
    {
        $this->gear = new Gear();
    }

    public function configureGear(array $gear = null)
    {
        $mainWeapon = null;
        $sideWeapon = null;

        if($gear)
        {

            foreach($gear as $item => $value)
            {
                ${$item} = $value;
            }
        }

        $this->gear->setMainWeapon($mainWeapon);
        $this->gear->setSideWeapon($sideWeapon);

    }

    /**
     * @return Gear
     */
    public function getGear(): Gear
    {
        return $this->gear;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return int
     */
    public function getHp(): int
    {
        return $this->hp;
    }

    /**
     * @param int $hp
     */
    public function setHp(int $hp): void
    {
        $this->hp = $hp;
    }

    /**
     * @return int
     */
    public function getMp(): int
    {
        return $this->mp;
    }

    /**
     * @param int $mp
     */
    public function setMp(int $mp): void
    {
        $this->mp = $mp;
    }

    /**
     * @return int
     */
    public function getDp(): int
    {
        return $this->dp;
    }

    /**
     * @param int $dp
     */
    public function setDp(int $dp): void
    {
        $this->dp = $dp;
    }

    /**
     * @return int
     */
    public function getExp(): int
    {
        return $this->exp;
    }

    /**
     * @param int $exp
     */
    public function setExp(int $exp): void
    {
        $this->exp = $exp;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->isBlocked;
    }

    /**
     * @param bool $isBlocked
     */
    public function setIsBlocked(bool $isBlocked): void
    {
        $this->isBlocked = $isBlocked;
    }

}
