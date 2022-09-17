<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;

final class UserGroup
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    protected string $label;
    protected string $description;
    protected int $roleId;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return UserGroup
     */
    public function setLabel(string $label): UserGroup
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
    public function setDescription(string $description): UserGroup
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     * @return UserGroup
     */
    public function setRoleId(int $roleId): UserGroup
    {
        $this->roleId = $roleId;
        return $this;
    }

}
