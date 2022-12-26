<?php

namespace App\Repository;

use App\Entity\UserGroup;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

/**
 * @method false|UserGroup find(int $id)
 * @method false|UserGroup findOneBy(array $data)
 * @method UserGroup[] findBy(array $data, array $sortBy = [], int $limit = null, int $offset = null)
 * @method UserGroup[] findAll(array $orderBy = [], int $limit = null, int $offset = null)
 */

class UserGroupRepository extends AbstractRepositoryFactory
{

    public function __construct()
    {
        parent::__construct(UserGroup::class);
    }

}
