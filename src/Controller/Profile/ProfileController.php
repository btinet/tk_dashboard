<?php

namespace App\Controller\Profile;

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

class ProfileController extends AbstractController
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
        $mainMenu->createMenu();
        $this->schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
            'repository' => $this->repository
        ]);

        $this->denyAccessUnlessHasPermission('show_profile');
    }

    public function index(): string
    {
        return $this->render('profile/index.html',[

        ]);
    }
}