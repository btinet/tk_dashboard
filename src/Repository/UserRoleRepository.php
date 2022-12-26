<?php

namespace App\Repository;

use App\Entity\RolePermission;
use App\Entity\User;
use App\Entity\UserGroup;
use App\Entity\UserRole;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

/**
 * @method false|UserRole find(int $id)
 * @method false|UserRole findOneBy(array $data)
 * @method UserRole[] findBy(array $data, array $sortBy = [], int $limit = null, int $offset = null)
 * @method UserRole[] findAll(array $orderBy = [], int $limit = null, int $offset = null)
 */

class UserRoleRepository extends AbstractRepositoryFactory
{

    public function __construct()
    {
        parent::__construct(UserRole::class);
    }


    public function findUsersJoinGroup(int $id, array $orderBy = ['u.last_name' => 'asc']): array
    {
        return $this->queryBuilder(User::class,'u')
            ->select('u.id, u.username, u.first_name as firstName , u.last_name as lastName')
            ->join('user_group_has_user','ughu','u.id = ughu.user_id')
            ->andWhere('ughu.user_group_id = :id')
            ->setParameter('id',$id)
            ->orderBy($orderBy)
            ->getQuery()
            ->getResult()
        ;

    }

    public function findSupervisorsByLoad(string $searchString = '"supervise_enable":"on"', array $orderBy = ['u.last_name' => 'asc']): array
    {
        return $this->queryBuilder(User::class,'u')
            ->select('u.id, u.username, u.first_name as firstName , u.last_name as lastName')
            ->join('user_role_has_user','urhu','u.id = urhu.user_id')
            ->andWhere('urhu.attribs LIKE :search_string')
            ->setParameter('search_string','%'.$searchString.'%')
            ->orderBy($orderBy)
            ->getQuery()
            ->getResult()
        ;

    }

    public function findByIdJoinPermissions(int $id, array $orderBy = []): array
    {
        return $this->queryBuilder(RolePermission::class,'p')
            ->select('p.id AS id, p.label AS label, p.description AS description')
            ->join('user_role_has_role_permission','rp','p.id = rp.role_permission_id')
            ->andWhere('rp.user_role_id = :id')
            ->setParameter('id',$id)
            ->orderBy($orderBy)
            ->getQuery()
            ->getResult()
        ;

    }

    public function findOnePermission(int $roleId, int $permissionId)
    {

        return $this->queryBuilder(RolePermission::class,'p')
            ->select('p.id')
            ->join('user_role_has_role_permission','rp','p.id = rp.role_permission_id')
            ->andWhere('rp.user_role_id = :role_id')
            ->andWhere('rp.role_permission_id = :permission_id')
            ->setParameter('role_id',$roleId)
            ->setParameter('permission_id',$permissionId)
            ->getQuery()
            ->getOneOrNullResult()
        ;

    }

    public function findUserRole(int $userId): array
    {
        return $this->queryBuilder(UserRole::class,'p')
            ->select('p.label')
            ->join('user_role_has_user','rp','p.id = rp.user_role_id')
            ->andWhere('rp.user_id = :user_id')
            ->setParameter('user_id',$userId)
            ->getQuery()
            ->getOneOrNullResult()
            ;

    }

    public function findUserRoles(int $userId, array $orderBy = []): array
    {
        return $this->queryBuilder(UserRole::class,'p')
            ->select('p.id, p.label')
            ->join('user_role_has_user','rp','p.id = rp.user_role_id')
            ->andWhere('rp.user_id = :id')
            ->setParameter('id',$userId)
            ->orderBy($orderBy)
            ->getQuery()
            ->getResult()
        ;

    }


    /**
     * @param int $groupId
     * @param string $roleLabel
     * @return false|User
     */
    public function findUserByRole(int $groupId, string $roleLabel)
    {
        return $this->queryBuilder(User::class,'user')
            ->select('user.first_name AS firstName, user.last_name AS lastName, user.id AS id, user.username AS username')
            ->join('user_group_has_user','user_group','user.id = user_group.user_id')
            ->join('user_role_has_user','user_roles','user.id = user_roles.user_id')
            ->join('user_role','role','user_roles.user_role_id = role.id')
            ->andWhere('user_group.user_group_id =  :group_id')
            ->andWhere('role.label =  :role_label')
            ->setParameter('group_id',$groupId)
            ->setParameter('role_label',$roleLabel)
            ->getQuery()
            ->getOneOrNullResult()
        ;

    }


    /**
     * @param int $userId
     * @param array $orderBy
     * @return UserGroup[]
     */
    public function findUserGroup(int $userId, array $orderBy = []): array
    {
        return $this->queryBuilder(UserGroup::class,'p')
            ->select('p.label, p.id, p.role_id AS roleId')
            ->join('user_group_has_user','rp','p.id = rp.user_group_id')
            ->andWhere('rp.user_id = :id')
            ->setParameter('id',$userId)
            ->orderBy($orderBy)
            ->getQuery()
            ->getResult()
        ;

    }

    /**
     * @param int $userId
     * @return false|UserGroup
     */
    public function findUserCurrentGroup(int $userId)
    {
        return $this->queryBuilder(UserGroup::class,'p')
            ->select('p.label, p.id, max(p.id) as max_id, p.role_id AS roleId')
            ->join('user_group_has_user','rp','p.id = rp.user_group_id')
            ->andWhere('rp.user_id =  :id')
            ->setParameter('id',$userId)
            ->getQuery()
            ->getOneOrNullResult()
        ;

    }


    /**
     * @param int $userId
     * @param array $orderBy
     * @return RolePermission[]
     */
    public function findUserPermissions(int $userId, array $orderBy = []): array
    {
        return $this->queryBuilder(RolePermission::class,'p')
            ->select('p.label')
            ->join('user_role_has_role_permission','rp','p.id = rp.role_permission_id')
            ->join('user_role','ur','rp.user_role_id = ur.id')
            ->join('user_role_has_user','urhu','urhu.user_role_id = ur.id')
            ->join('user','u','urhu.user_id = u.id')
            ->andWhere('urhu.user_id = :id')
            ->setParameter('id',$userId)
            ->orderBy($orderBy)
            ->getQuery()
            ->getResult()
        ;

    }


    /**
     * @param int $roleId
     * @param array $orderBy
     * @return RolePermission[]
     */
    public function findRolePermissions(int $roleId, array $orderBy = []): array
    {
        return $this->queryBuilder(RolePermission::class,'p')
            ->select('p.label')
            ->join('user_role_has_role_permission','rp','p.id = rp.role_permission_id')
            ->join('user_role','ur','rp.user_role_id = ur.id')
            ->andWhere('ur.user_role_id = :id')
            ->setParameter('id',$roleId)
            ->orderBy($orderBy)
            ->getQuery()
            ->getResult()
            ;

    }

}
