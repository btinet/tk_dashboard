<?php

namespace App\RpgCharacter;

class WeaponType
{

    protected int $int;

    protected string $type;

    protected int $strength;

    protected bool $isOffensive;

    protected bool $isDefensive;

    /**
     * @return int
     */
    public function getInt(): int
    {
        return $this->int;
    }

    /**
     * @param int $int
     */
    public function setInt(int $int): void
    {
        $this->int = $int;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     */
    public function setStrength(int $strength): void
    {
        $this->strength = $strength;
    }


    /**
     * @return bool
     */
    public function isOffensive(): bool
    {
        return $this->isOffensive;
    }

    /**
     * @param bool $isOffensive
     */
    public function setIsOffensive(bool $isOffensive): void
    {
        $this->isOffensive = $isOffensive;
    }

    /**
     * @return bool
     */
    public function isDefensive(): bool
    {
        return $this->isDefensive;
    }

    /**
     * @param bool $isDefensive
     */
    public function setIsDefensive(bool $isDefensive): void
    {
        $this->isDefensive = $isDefensive;
    }

}
