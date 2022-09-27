<?php

namespace App\Controller\Admin;

use App\Entity\Exam;
use App\Entity\RolePermission;
use App\Entity\SchoolSubject;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
use App\Type\TableType;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Component\MenuComponent\AbstractMenu;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class ExamCrudController extends AbstractController
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
                    $result = $em->remove(Exam::class,$id);
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
            ->configureComponent(Exam::class)
            ->setData($this->getRepositoryManager()->findAll(Exam::class,[],5))
            ->setCaption('Prüfungen')
            ->addIdentifier('keyQuestion','admin_exam_index','id')
            ->add('year','year')
        ;

        return $this->render('admin/permission/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'userData' => $userData,
            'table' => $table->render()
        ]);
    }

}