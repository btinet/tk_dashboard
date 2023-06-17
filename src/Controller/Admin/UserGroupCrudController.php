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

    /**
     * @var array|false|string
     */
    private $schoolSubjects;
    private AbstractMenu $adminMenu;

    public function __construct()
    {
        parent::__construct();
        $mainMenu = new MenuBuilder($this->session->getUser());
        $this->adminMenu = new AdminMenu($this->session->getUser());
        $mainMenu->createMenu();
        $this->schoolSubjects = $this->getRepositoryManager(SchoolSubject::class)->findAll(['label' => 'asc']);
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
        ]);

        $this->denyAccessUnlessHasPermission('show_group','admin_index');
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
            ->setData($this->getRepositoryManager(UserGroup::class)->findAll())
            ->setCaption('Gruppenübersicht')
            ->addIdentifier('label','admin_group_index','id')
            ->addIdentifier('role','admin_role_show','roleId')
            ->add('description')
            ->add('groupKey')
            ->add('created','date')
            ->add('updated','date')
        ;

        return $this->render('admin/group/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'objects' => $this->getRepositoryManager(UserGroup::class)->findAll(),
            'userRoles' => $this->getRepositoryManager(UserRole::class)->findAll(),
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

            if(0 === $em->isUnique('label', $this->request->getFieldAsString('label'),$this->getRepositoryManager(UserGroup::class)))
            {
                $entity->setLabel($this->request->getFieldAsString('label'));
                $entity->setDescription($this->request->getFieldAsString('description'));
                $entity->setGroupKey($this->generateRandomString());
                $entity->setRoleId($this->request->getFieldAsString('role_id'));
                $em->persist($entity);

                $this->response->redirectToRoute(302,'admin_group_index');
            }
        }
        $this->response->redirectToRoute(302,'admin_group_index');
    }

}