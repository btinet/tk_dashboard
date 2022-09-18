<?php

namespace App\Entity;

use App\Repository\UserRoleRepository;
use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

final class UserRole
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    private AbstractRepositoryFactory $repository;

    protected string $label;
    protected string $description;

    public function __construct()
    {
        $this->repository = new UserRoleRepository();
    }

    public function __toString()
    {
        return $this->label;
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

    public function getPermissions()
    {
        $permission = $this->repository->findByIdJoinPermissions($this->id,['label' => 'asc']);
        if(!array_filter((array)$permission)) return false;
        return $permission;
    }

}
