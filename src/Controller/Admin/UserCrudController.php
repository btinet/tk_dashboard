<?php

namespace App\Controller\Admin;

use App\Entity\SchoolSubject;
use App\Entity\User;
use App\Entity\UserGroup;
use App\Entity\UserRole;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
use App\Repository\SchoolSubjectRepository;
use App\Repository\UserRepository;
use App\Repository\UserRoleRepository;
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
            ->configureComponent(User::class)
            ->setData($this->getRepositoryManager(User::class)->findAll())
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
            ->add('created','date')
            ->add('updated','date')
        ;

        return $this->render('admin/group/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'objects' => $this->getRepositoryManager(User::class)->findAll(),
            'userRoles' => $this->repository->findAll(),
            'userData' => $userData,
            'table' => $table->render()
        ]);
    }

}