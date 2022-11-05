<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;

final class RolePermission
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
     * @return RolePermission
     */
    public function setLabel(string $label): RolePermission
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
     * @return UserGroup
     */
    public function setDescription(string $description): RolePermission
    {
        $this->description = $description;
        return $this;
    }

}
