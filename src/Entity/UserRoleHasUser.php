<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;

class UserRoleHasUser
{

    use IdEntityTrait;
    use DateTimeEntityTrait;

    protected int $userId;

    protected int $userRoleId;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return UserRoleHasUser
     */
    public function setUserId(int $userId): UserRoleHasUser
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserRoleId(): int
    {
        return $this->userRoleId;
    }

    /**
     * @param int $userRoleId
     * @return UserRoleHasUser
     */
    public function setUserRoleId(int $userRoleId): UserRoleHasUser
    {
        $this->userRoleId = $userRoleId;
        return $this;
    }

}
