<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;

final class UserRoleHasRolePermission
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    protected int $userRoleId;
    protected int $rolePermissionId;

    /**
     * @return int
     */
    public function getUserRoleId(): int
    {
        return $this->userRoleId;
    }

    /**
     * @param int $userRoleId
     * @return UserRoleHasRolePermission
     */
    public function setUserRoleId(int $userRoleId): UserRoleHasRolePermission
    {
        $this->userRoleId = $userRoleId;
        return $this;
    }

    /**
     * @return int
     */
    public function getRolePermissionId(): int
    {
        return $this->rolePermissionId;
    }

    /**
     * @param int $rolePermissionId
     * @return UserRoleHasRolePermission
     */
    public function setRolePermissionId(int $rolePermissionId): UserRoleHasRolePermission
    {
        $this->rolePermissionId = $rolePermissionId;
        return $this;
    }

}
