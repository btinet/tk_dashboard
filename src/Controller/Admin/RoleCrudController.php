<?php

namespace App\Controller\Admin;

use App\Entity\RolePermission;
use App\Entity\SchoolSubject;
use App\Entity\UserRole;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
use App\Repository\UserRoleRepository;
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
        $mainMenu = new MenuBuilder();
        $this->adminMenu = new AdminMenu();
        $mainMenu->createMenu();
        $this->schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
            'repository' => $this->repository
        ]);
    }

    public function index(): string
    {

        if($this->request->isPostRequest() and $this->request->isFormSubmitted())
        {
            $em = new EntityManager();

            foreach($this->request->getFieldAsArray('mark_row') as $key => $id)
            {
                print_r($id);
                $em->remove(UserRole::class,$id);
            }
        }


        $this->adminMenu->createMenu();
        $userData = [];

        return $this->render('admin/role/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'objects' => $this->getRepositoryManager()->findAll(UserRole::class),
            'userData' => $userData
        ]);
    }

    /**
     * @param int|null $id
     */
    public function show(int $id = null):string
    {
        $this->adminMenu->createMenu();
        $userData = [];

        $object = $this->getRepositoryManager()->find(UserRole::class, $id);
        $permissions = $this->repository->findAll(RolePermission::class);

        if(!array_filter((array)$object))
        {
            $this->response->redirectToRoute(302,'admin_role_index');
        }

        return $this->render('admin/role/show.html',[
            'adminMenu' => $this->adminMenu->render(),
            'object' => $object,
            'permissions' => $permissions,
            'userData' => $userData
        ]);
    }

    public function new()
    {
        $this->adminMenu->createMenu();
        $userData = [];

        if($this->request->isFormSubmitted() and $this->request->isPostRequest())
        {
            $em = new EntityManager();
            $role = new UserRole();

            if(0 === $em->isUnique(UserRole::class,'label', $this->request->getFieldAsString('label'),$this->getRepositoryManager()))
            {
                $role->setLabel($this->request->getFieldAsString('label'));
                $role->setDescription($this->request->getFieldAsString('description'));
                $em->persist($role);

                $this->response->redirectToRoute(302,'admin_role_index');
            }
        }
        $this->response->redirectToRoute(302,'admin_role_index');
    }

}