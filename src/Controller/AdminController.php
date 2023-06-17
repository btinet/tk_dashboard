<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Entity\SchoolSubject;
use App\Entity\UserGroup;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
use App\Repository\ExamRepository;
use Core\Component\MenuComponent\AbstractMenu;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class AdminController extends AbstractController
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
        $this->repository = new ExamRepository();
        $mainMenu = new MenuBuilder($this->session->getUser());
        $this->adminMenu = new AdminMenu($this->session->getUser());
        $mainMenu->createMenu();
        $this->schoolSubjects = $this->getRepositoryManager(SchoolSubject::class)->findAll(['label' => 'asc']);

        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render()
        ]);


        $this->denyAccessUnlessHasPermission('show_dashboard');

    }

    public function index(): string
    {
        $this->adminMenu->createMenu();

        $examCount = $this->repository->countDistinctBy('key_question');

        return $this->render('admin/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'examCount' => $examCount,
            'groupEntity' => $this->getRepositoryManager(UserGroup::class)->findAll()
        ]);
    }

}