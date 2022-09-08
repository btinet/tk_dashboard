<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Entity;

class KaffeeMaschine
{

    /**
     * @var bool Kaffeemaschine ist ein- oder ausgeschaltet
     */
    protected bool $isOn = false;

    /**
     * @var bool Kaffeemaschine ist bereit zum Kaffeekochen
     */
    protected bool $isReady = false;

    /**
     * @var int Füllmenge Wasser im Wassertank
     */
    protected int $amountOfWater = 0;

    /**
     * @var int Füllmenge Kaffee im Kaffeeeinsatz
     */
    protected int $amountOfCoffee = 0;

    /**
     * @return bool
     */
    public function isOn(): bool
    {
        return $this->isOn;
    }

    /**
     * @param bool $isOn
     * @return KaffeeMaschine
     */
    public function setIsOn(bool $isOn): KaffeeMaschine
    {
        $this->isOn = $isOn;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReady(): bool
    {
        return $this->isReady;
    }

    /**
     * @param bool $isReady
     * @return KaffeeMaschine
     */
    public function setIsReady(bool $isReady): KaffeeMaschine
    {
        $this->isReady = $isReady;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmountOfWater(): int
    {
        return $this->amountOfWater;
    }

    /**
     * @param int $amountOfWater
     * @return KaffeeMaschine
     */
    public function setAmountOfWater(int $amountOfWater): KaffeeMaschine
    {
        $this->amountOfWater = $amountOfWater;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmountOfCoffee(): int
    {
        return $this->amountOfCoffee;
    }

    /**
     * @param int $amountOfCoffee
     * @return KaffeeMaschine
     */
    public function setAmountOfCoffee(int $amountOfCoffee): KaffeeMaschine
    {
        $this->amountOfCoffee = $amountOfCoffee;
        return $this;
    }

}
