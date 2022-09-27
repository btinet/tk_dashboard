<?php

namespace App\Controller\Admin;

use App\Entity\RolePermission;
use App\Entity\SchoolSubject;
use App\Entity\User;
use App\Entity\UserGroup;
use App\Entity\UserRole;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
use App\Type\TableType;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Component\MenuComponent\AbstractMenu;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class UserGroupCrudController extends AbstractController
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

        if($this->request->isPostRequest() and $this->request->isFormSubmitted())
        {
            $em = new EntityManager();

            if($this->request->getFieldAsArray('mark_row')){
                foreach($this->request->getFieldAsArray('mark_row') as $key => $id)
                {
                    $em->remove(UserGroup::class,$id);
                }
            }
        }

        $table = new TableType($this->getView());
        $table
            ->configureComponent(UserGroup::class)
            ->setData($this->getRepositoryManager()->findAll(UserGroup::class))
            ->setCaption('Gruppenübersicht')
            ->addIdentifier('label','admin_group_index','id')
            ->addIdentifier('role','admin_role_show','roleId')
            ->add('description')
            ->add('created')
            ->add('updated')
        ;

        return $this->render('admin/group/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'objects' => $this->getRepositoryManager()->findAll(UserGroup::class),
            'userRoles' => $this->repository->findAll(UserRole::class),
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
            $entity = new UserGroup();

            if(0 === $em->isUnique(UserGroup::class,'label', $this->request->getFieldAsString('label'),$this->getRepositoryManager()))
            {
                $entity->setLabel($this->request->getFieldAsString('label'));
                $entity->setDescription($this->request->getFieldAsString('description'));
                $entity->setRoleId($this->request->getFieldAsString('role_id'));
                $em->persist($entity);

                $this->response->redirectToRoute(302,'admin_group_index');
            }
        }
        $this->response->redirectToRoute(302,'admin_group_index');
    }

}