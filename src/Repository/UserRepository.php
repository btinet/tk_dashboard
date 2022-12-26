<?php

namespace App\Repository;

use App\Entity\User;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

/**
 * @method false|User find(int $id)
 * @method false|User findOneBy(array $data)
 * @method User[] findBy(array $data, array $sortBy = [], int $limit = null, int $offset = null)
 * @method User[] findAll(array $orderBy = [], int $limit = null, int $offset = null)
 */

class UserRepository extends AbstractRepositoryFactory
{

    public function __construct()
    {
        parent::__construct(User::class);
    }

}
