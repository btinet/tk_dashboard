<?php

namespace App\Entity;

use App\Repository\UserRoleRepository;
use App\Service\EncryptionService;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Component\UserComponent\PasswordService;
use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;
use ReflectionException;
use stdClass;

final class User
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    private AbstractRepositoryFactory $repository;
    private EntityManager $entityManager;
    private int $userRoleId;
    private EncryptionService $encryptionService;

    protected ?string $firstName;
    protected ?string $lastName;
    protected string $username;
    protected string $password;
    protected string $email;
    protected bool $isActive;
    protected ?string $userLocale;

    public function __construct()
    {
        $this->repository = new UserRoleRepository();
        $this->entityManager = new EntityManager();
        $this->encryptionService = new EncryptionService();
    }

    public function __toString()
    {
        return $this->username;
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getFirstName($decrypt = false): ?string
    {
        $firstName = $this->firstName;
        if($decrypt)
        {
            $firstName = $this->encryptionService->decryptString($firstName);
        }
        return $firstName;
    }

    /**
     * @param string|null $firstName
     * @return User
     */
    public function setFirstName(?string $firstName): User
    {
        $this->firstName = $this->encryptionService->encryptString($firstName);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName($decrypt = false): ?string
    {
        $lastName = $this->lastName;
        if($decrypt)
        {
            $lastName = $this->encryptionService->decryptString($lastName);
        }
        return $lastName;
    }

    /**
     * @param string|null $lastName
     * @return User
     */
    public function setLastName(?string $lastName): User
    {
        $this->lastName = $this->encryptionService->encryptString($lastName);
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername($decrypt = false): string
    {
        $username = $this->username;
        if($decrypt)
        {
            $username = $this->encryptionService->decryptString($username);
        }
        return $username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $this->encryptionService->encryptString($username);
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = PasswordService::hash($password);
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail($decrypt = false): string
    {
        $email = $this->email;
        if($decrypt)
        {
            $email = $this->encryptionService->decryptString($email);
        }
        return $email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $this->encryptionService->encryptString($email);
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return User
     */
    public function setIsActive(bool $isActive): User
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUserLocale(): string
    {
        return $this->userLocale;
    }

    /**
     * @param string $userLocale
     * @return User
     */
    public function setUserLocale(string $userLocale): User
    {
        $this->userLocale = $userLocale;
        return $this;
    }

    public function getRole()
    {
        return $this->repository->findUserRole($this->id);
    }

    public function getRoles()
    {
        return $this->repository->findUserRoles($this->id);
    }

    public function getGroup()
    {
        return $this->repository->findUserGroup($this->id);
    }

    public function getCurrentGroup(): UserGroup
    {
        return $this->repository->findUserCurrentGroup($this->id);
    }

    public function hasGroupPermission(string $condition): bool
    {
        $response = false;
        foreach ($this->getGroup() as $group)
        {
            if($group->getRole()->getPermissions())
            {
                foreach ($group->getRole()->getPermissions() as $permission){
                    if($permission->getLabel() == $condition)
                    {
                        $response = true;
                    }
                }
            }
        }
        return $response;
    }

    public function getPermissions()
    {
        return $this->repository->findUserPermissions($this->id);
    }

    /**
     * @param int $userRoleId
     * @return User
     */
    public function setUserRoleId(int $userRoleId = 10): User
    {
        $user = $this->repository->findOneBy(User::class,['username' => $this->getUsername()]);
        if(!$userHasRole = $this->repository->find(UserRoleHasUser::class,$user->getId())){
            $userRole = new UserRoleHasUser();
            $userRole
                ->setUserId($user->getId())
                ->setUserRoleId($userRoleId)
                ->setAttribs([])
                ->setFromDate(date('now'))
                ->setToDate(NULL)
            ;
            try {
                $this->entityManager->persist($userRole);
            } catch (ReflectionException $e) {
            }
        };
        $this->userRoleId = $userRoleId;
        return $this;
    }

    /**
     * @param int $roleId
     * @return null|mixed
     */
    public function getRoleAtrribs(int $roleId = 18)
    {
        $result = $this->repository->findOneBy(UserRoleHasUser::class,['user_id'=>$this->id,'user_role_id'=>$roleId]);
        return ($result)? $result->getAttribsAsArray():null;
    }

}
