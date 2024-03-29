<?php

namespace App\Controller\Admin;

use App\Entity\RolePermission;
use App\Entity\SchoolSubject;
use App\Entity\UserRole;
use App\Entity\UserRoleHasRolePermission;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
use App\Repository\UserRoleRepository;
use App\Type\TableType;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Component\MenuComponent\AbstractMenu;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class RoleCrudController extends AbstractController
{

    protected AbstractRepositoryFactory $repository;

    /**
     * @var array|false|string
     */
    private $schoolSubjects;
    private AbstractMenu $adminMenu;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new UserRoleRepository();
        $mainMenu = new MenuBuilder($this->session->getUser());
        $this->adminMenu = new AdminMenu($this->session->getUser());
        $mainMenu->createMenu();
        $this->schoolSubjects = $this->getRepositoryManager(SchoolSubject::class)->findAll(['label' => 'asc']);
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
            'repository' => $this->repository
        ]);

        $this->denyAccessUnlessHasPermission('show_role');
    }

    public function index(): string
    {
        $table = new TableType($this->getView());
        $table
            ->configureComponent(UserRole::class)
            ->setData($this->getRepositoryManager(UserRole::class)->findAll([],100))
            ->setCaption('Rollenübersicht')
            ->addIdentifier('label','admin_role_show','id')
            ->add('description')
            ->add('created','date')
            ->add('updated','date')
        ;

        if($this->request->isPostRequest() and $this->request->isFormSubmitted())
        {
            $em = new EntityManager();

            if($this->request->getFieldAsArray('mark_row')){
                foreach($this->request->getFieldAsArray('mark_row') as $key => $id)
                {
                    $result = $em->remove(UserRole::class,$id);
                    print_r($result);
                }
                $this->setFlash('role_deleted');

                $this->response->redirectToRoute(302,'admin_role_index');
            }
        }

        $this->adminMenu->createMenu();
        $userData = [];

        return $this->render('admin/role/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'objects' => $this->getRepositoryManager(UserRole::class)->findAll([],100),
            'userData' => $userData,
            'table' => $table->render()
        ]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function show(int $id):string
    {
        $object = $this->getRepositoryManager(UserRole::class)->find($id);

        if($this->request->getFieldAsArray('mark_row')){
            foreach($this->request->getFieldAsArray('mark_row') as $permission)
            {
                $object->removePermission($permission);
            }
            $this->setFlash('permission_removed');
            $this->response->redirectToRoute(302,$this->generateUrlFromRoute('admin_role_show',[$id]),true);
        }

        $this->adminMenu->createMenu();
        $userData = [];

        $permissions = $this->getRepositoryManager(RolePermission::class)->findAll([],100);

        $table = new TableType($this->getView());
        $table
            ->configureComponent(RolePermission::class)
            ->setData($object->getPermissions())
            ->setCaption('Berechtigungen')
            ->add('label')
            ->add('description')
        ;

        if(!array_filter((array)$object))
        {
            $this->setFlash('role_not_found','danger');
            $this->response->redirectToRoute(302,'admin_role_index');
        }

        return $this->render('admin/role/show.html',[
            'adminMenu' => $this->adminMenu->render(),
            'object' => $object,
            'permissions' => $permissions,
            'userData' => $userData,
            'table' => $table->render()
        ]);
    }

    public function new()
    {
        if($this->request->isFormSubmitted() and $this->request->isPostRequest())
        {
            $em = new EntityManager();
            $role = new UserRole();

            if(0 === $em->isUnique('label', $this->request->getFieldAsString('label'),$this->getRepositoryManager(UserRole::class)))
            {
                $role->setLabel($this->request->getFieldAsString('label'));
                $role->setDescription($this->request->getFieldAsString('description'));
                $em->persist($role);

                $this->setFlash('role_saved');
                $this->response->redirectToRoute(302,'admin_role_index');
            }
        }
        $this->response->redirectToRoute(302,'admin_role_index');
    }

    public function addPermission()
    {
        if($this->request->isFormSubmitted() and $this->request->isPostRequest())
        {
            $em = new EntityManager();
            $rolePermission = new UserRoleHasRolePermission();

            foreach ($this->request->getFieldAsArray('permissions') as $permissionId)
            {
                if($permissionId)
                {
                    $rolePermission->setUserRoleId($this->request->getFieldAsArray('role_id'));
                    $rolePermission->setRolePermissionId($permissionId);
                    $em->persist($rolePermission);
                }
            }
            $this->setFlash('permission_added');
        }
        $this->response->redirectToRoute(302,$this->generateUrlFromRoute('admin_role_show',[$this->request->getFieldAsArray('role_id')]),true);
    }

}