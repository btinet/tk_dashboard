<?php

namespace App\Repository;

use App\Entity\RolePermission;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;
use PDOException;
use ReflectionException;

class UserRoleRepository extends AbstractRepositoryFactory
{

    /**
     * @return array|false
     */
    public function findByIdJoinPermissions(int $id, array $sortBy = [], string $entity = RolePermission::class)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $table = self::generateSnakeTailString($entityClass->getShortName());


            $orderData = self::createOrderData($sortBy);
            $result = self::select
            ("
                SELECT p.id AS id, p.label AS label, p.description AS description
                FROM {$table} p
                    INNER JOIN user_role_has_role_permission rp
                        ON (p.id = rp.role_permission_id)
                WHERE rp.user_role_id = {$id}
                {$orderData}
                    ");
            return $result->fetchAll(self::FETCH_CLASS, $entity);
        } catch (PDOException|ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return array|false
     */
    public function findOnePermission(int $roleId, int $permissonId, array $sortBy = [], string $entity = RolePermission::class)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $table = self::generateSnakeTailString($entityClass->getShortName());


            $orderData = self::createOrderData($sortBy);
            $result = self::select
            ("
                SELECT p.id
                FROM {$table} p
                    INNER JOIN user_role_has_role_permission rp
                        ON (p.id = rp.role_permission_id)
                WHERE rp.user_role_id = {$roleId}
                AND rp.role_permission_id = {$permissonId}
                {$orderData}
                    ");
            return $result->fetchObject($entity);
        } catch (PDOException|ReflectionException $e) {
            return $e->getMessage();
        }
    }

}