<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Entity;

class Mensch
{

    /**
     * @var bool Mensch ist entweder müde oder nicht
     */
    protected bool $isTired = true;

    /**
     * @var int Menge des getrunkenen Kaffees in Millimeter
     */
    protected int $coffeeAmount = 0;

    /**
     * @return bool
     */
    public function isTired(): bool
    {
        return $this->isTired;
    }

    /**
     * @param bool $isTired
     * @return Mensch
     */
    public function setIsTired(bool $isTired): Mensch
    {
        $this->isTired = $isTired;
        return $this;
    }

    /**
     * @return int
     */
    public function getCoffeeAmount(): int
    {
        return $this->coffeeAmount;
    }

    /**
     * @param int $coffeeAmount
     * @return Mensch
     */
    public function setCoffeeAmount(int $coffeeAmount): Mensch
    {
        $this->coffeeAmount = $coffeeAmount;
        return $this;
    }

}
