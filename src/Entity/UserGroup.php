<?php

namespace App\Entity;

use App\Repository\UserRoleRepository;
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
    protected ?string $groupKey;
    protected int $roleId;

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
     * @return string|null
     */
    public function getGroupKey(): ?string
    {
        return $this->groupKey;
    }

    /**
     * @param string $groupKey
     * @return UserGroup
     */
    public function setGroupKey(string $groupKey): UserGroup
    {
        $this->groupKey = $groupKey;
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

    public function getTutor($roleLabel = 'Tutor:in')
    {
        return $this->repository->findUserByRole($this->getId(),$roleLabel);
    }

    public function getUsers()
    {
        return $this->repository->findUsersJoinGroup($this->getId());
    }

}
