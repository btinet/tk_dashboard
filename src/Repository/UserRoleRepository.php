<?php

namespace App\Repository;

use App\Entity\RolePermission;
use App\Entity\User;
use App\Entity\UserGroup;
use App\Entity\UserRole;
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


    /**
     * @return array|false
     */
    public function findUserRole(int $userId, string $entity = UserRole::class)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $table = self::generateSnakeTailString($entityClass->getShortName());
            $result = self::select
            ("
                SELECT p.label
                FROM {$table} p
                    INNER JOIN user_role_has_user rp
                        ON (p.id = rp.user_role_id)
                WHERE rp.user_id = {$userId}
                    ");
            return $result->fetchObject($entity);
        } catch (PDOException|ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return array|false
     */
    public function findUserRoles(int $userId, string $entity = UserRole::class)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $table = self::generateSnakeTailString($entityClass->getShortName());
            $result = self::select
            ("
                SELECT p.id, p.label
                FROM {$table} p
                    INNER JOIN user_role_has_user rp
                        ON (p.id = rp.user_role_id)
                WHERE rp.user_id = {$userId}
                    ");
            return $result->fetchAll(self::FETCH_CLASS,$entity);
        } catch (PDOException|ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return User|false
     */
    public function findUserByRole(int $groupId,string $roleLabel, string $entity = User::class)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $table = self::generateSnakeTailString($entityClass->getShortName());
            $result = self::select
            ("
                SELECT user.first_name AS firstName, user.last_name AS lastName, user.id AS id, user.username AS username
                FROM user
                INNER JOIN user_group_has_user user_group ON (user.id = user_group.user_id)
                INNER JOIN user_role_has_user user_roles ON (user.id = user_roles.user_id)
                INNER JOIN user_role role ON (user_roles.user_role_id = role.id)
                WHERE user_group.user_group_id = {$groupId}
                AND role.label = '".$roleLabel."'               
                    ");
            return $result->fetchObject($entity);
        } catch (PDOException|ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return array|false
     */
    public function findUserGroup(int $userId, string $entity = UserGroup::class)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $table = self::generateSnakeTailString($entityClass->getShortName());
            $result = self::select
            ("
                SELECT p.label, p.id, p.role_id AS roleId
                FROM {$table} p
                    INNER JOIN user_group_has_user rp
                        ON (p.id = rp.user_group_id) 
                WHERE rp.user_id = {$userId}
                    ");
            return $result->fetchAll(self::FETCH_CLASS,$entity);
        } catch (PDOException|ReflectionException $e) {
            return $e->getMessage();
        }
    }

    public function findUserCurrentGroup(int $userId, string $entity = UserGroup::class)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $table = self::generateSnakeTailString($entityClass->getShortName());
            $result = self::select
            ("
                SELECT p.label, p.id, max(p.id) as max_id, p.role_id AS roleId
                FROM {$table} p
                    INNER JOIN user_group_has_user rp
                        ON (p.id = rp.user_group_id) 
                WHERE rp.user_id = {$userId}
                    ");
            return $result->fetchObject($entity);
        } catch (PDOException|ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return array|false
     */
    public function findUserPermissions(int $userId, string $entity = RolePermission::class)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $table = self::generateSnakeTailString($entityClass->getShortName());
            $result = self::select
            ("
                SELECT p.label
                FROM {$table} p
                    INNER JOIN user_role_has_role_permission rp
                        ON (p.id = rp.role_permission_id)
                    INNER JOIN user_role ur
                        ON (rp.user_role_id = ur.id)
                    INNER JOIN user_role_has_user urhu
                        ON (urhu.user_role_id = ur.id)
                    INNER JOIN user u
                        ON (urhu.user_id = u.id)
                
                WHERE urhu.user_id = {$userId}
                    ");
            return $result->fetchAll(self::FETCH_CLASS,$entity);
        } catch (PDOException|ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return array|false
     */
    public function findRolePermissions(int $roleId, string $entity = RolePermission::class)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $table = self::generateSnakeTailString($entityClass->getShortName());
            $result = self::select
            ("
                SELECT p.label
                FROM {$table} p
                    INNER JOIN user_role_has_role_permission rp
                        ON (p.id = rp.role_permission_id)
                    INNER JOIN user_role ur
                        ON (rp.user_role_id = ur.id)                
                WHERE ur.user_role_id = {$roleId}
                    ");
            return $result->fetchAll(self::FETCH_CLASS,$entity);
        } catch (PDOException|ReflectionException $e) {
            return $e->getMessage();
        }
    }

}