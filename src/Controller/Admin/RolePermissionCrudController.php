<?php

namespace App\Controller\Admin;

use App\Entity\RolePermission;
use App\Entity\SchoolSubject;
use App\Entity\UserGroup;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
use App\Type\TableType;
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
        $mainMenu = new MenuBuilder($this->session->getUser());
        $this->adminMenu = new AdminMenu($this->session->getUser());
        $mainMenu->createMenu();
        $this->schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
        ]);

        $this->denyAccessUnlessHasPermission('show_permission');
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
                    if($result == 1)
                    {
                        $this->setFlash($result);
                    } else {
                        $this->setFlash($result,'warning');
                    }

                }
                $this->response->redirectToRoute(302,'admin_permission_index');
            }
        }

        $this->adminMenu->createMenu();
        $userData = [];

        $table = new TableType($this->getView());
        $table
            ->configureComponent(RolePermission::class)
            ->setData($this->getRepositoryManager()->findAll(RolePermission::class,[],100))
            ->setCaption('Gruppen??bersicht')
            ->addIdentifier('label','admin_permission_index','id')
            ->add('description')
            ->add('created','date')
            ->add('updated','date')
        ;

        return $this->render('admin/permission/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'objects' => $this->getRepositoryManager()->findAll(RolePermission::class),
            'userData' => $userData,
            'table' => $table->render()
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