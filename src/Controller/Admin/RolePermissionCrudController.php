<?php

namespace App\Controller\Admin;

use App\Entity\RolePermission;
use App\Entity\SchoolSubject;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Component\MenuComponent\AbstractMenu;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class RolePermissionCrudController extends AbstractController
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
        $this->repository = new AbstractRepositoryFactory();
        $mainMenu = new MenuBuilder();
        $this->adminMenu = new AdminMenu();
        $mainMenu->createMenu();
        $this->schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
        ]);
    }

    public function index(): string
    {
        if($this->request->isPostRequest() and $this->request->isFormSubmitted())
        {
            $em = new EntityManager();

            if($this->request->getFieldAsArray('mark_row')){
                foreach($this->request->getFieldAsArray('mark_row') as $key => $id)
                {
                    $result = $em->remove(RolePermission::class,$id);
                    $this->setFlash($result,'warning');
                }
                $this->response->redirectToRoute(302,'admin_permission_index');
            }
        }

        $this->adminMenu->createMenu();
        $userData = [];

        return $this->render('admin/permission/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'objects' => $this->getRepositoryManager()->findAll(RolePermission::class),
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
            $role = new RolePermission();

            if(0 === $em->isUnique(RolePermission::class,'label', $this->request->getFieldAsString('label'),$this->getRepositoryManager()))
            {
                $role->setLabel($this->request->getFieldAsString('label'));
                $role->setDescription($this->request->getFieldAsString('description'));
                $em->persist($role);

                $this->response->redirectToRoute(302,'admin_permission_index');
            }
        }
        $this->response->redirectToRoute(302,'admin_permission_index');
    }

}