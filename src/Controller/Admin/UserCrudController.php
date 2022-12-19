<?php

namespace App\Controller\Admin;

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

class UserCrudController extends AbstractController
{

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
            ->configureComponent(User::class)
            ->setData($this->getRepositoryManager()->findAll(User::class))
            ->setCaption('Gruppenübersicht')
            ->addIdentifier('username','admin_user_index','id',false,[
                'parameter'=>true,
                'is_header'=>true
            ])
            ->add('firstName',false,[
                'parameter'=>true,
                'is_header'=>true
            ])
            ->add('lastName',false,[
                'parameter'=>true,
                'is_header'=>true
            ])
        ;

        return $this->render('admin/group/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'objects' => $this->getRepositoryManager()->findAll(User::class),
            'userRoles' => $this->repository->findAll(UserRole::class),
            'userData' => $userData,
            'table' => $table->render()
        ]);
    }

}