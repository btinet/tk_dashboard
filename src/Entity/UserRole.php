<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;

final class UserRole
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    protected string $label;
    protected string $description;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return UserRole
     */
    public function setLabel(string $label): UserRole
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return UserRole
     */
    public function setDescription(string $description): UserRole
    {
        $this->description = $description;
        return $this;
    }

}
