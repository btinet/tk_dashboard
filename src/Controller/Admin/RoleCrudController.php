<?php

namespace App\Controller\Admin;

use App\Entity\SchoolSubject;
use App\Entity\UserRole;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
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
        $this->adminMenu->createMenu();
        $userData = [];

        return $this->render('admin/role/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'objects' => $this->getRepositoryManager()->findAll(UserRole::class),
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