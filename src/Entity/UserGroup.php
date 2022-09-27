<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

final class UserGroup
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    private AbstractRepositoryFactory $repository;
    private UserRole $role;

    protected string $label;
    protected string $description;
    protected int $roleId;

    public function __construct()
    {
        $this->repository = new AbstractRepositoryFactory();
    }

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

    public function getRole()
    {
        $role = $this->repository->findOneBy(UserRole::class,[
            'id' => $this->roleId
        ]);
        if(!array_filter((array)$role)) return false;
        return $role;
    }

}
