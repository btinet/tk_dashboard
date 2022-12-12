<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;
use stdClass;

class UserRoleHasUser
{

    use IdEntityTrait;
    use DateTimeEntityTrait;

    protected int $userId;
    protected int $userRoleId;
    protected string $attribs;

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


    public function getAttribs(): string
    {
        return $this->attribs;
    }

    public function getAttribsAsArray(): ?Array
    {
        return json_decode($this->attribs,JSON_OBJECT_AS_ARRAY);
    }

    /**
     * @param array $attribs
     * @return UserRoleHasUser
     */
    public function setAttribs(array $attribs): UserRoleHasUser
    {
        $this->attribs = json_encode($attribs,JSON_FORCE_OBJECT);
        return $this;
    }

}
