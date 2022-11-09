<?php

namespace App\Controller\Admin;

use App\Entity\Exam;
use App\Entity\RolePermission;
use App\Entity\SchoolSubject;
use App\Entity\Topic;
use App\Entity\UserGroup;
use App\Entity\UserRole;
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
        $mainMenu = new MenuBuilder($this->session->getUser());
        $this->adminMenu = new AdminMenu($this->session->getUser());
        $mainMenu->createMenu();
        $this->schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
        ]);

        $this->denyAccessUnlessHasPermission('show_exam');
    }

    public function index(): string
    {

        $offset = $this->request->getQueryAsString('page') ?: 0;

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

        $rows = $this->getRepositoryManager()->count(Exam::class);

        $table = new TableType($this->getView());
        $table
            ->configureComponent(Exam::class)
            ->setData($this->getRepositoryManager()->findAll(Exam::class,['year'=>'desc'],20,$offset*20))
            ->setCaption('Prüfungen')
            ->addIdentifier('keyQuestion','admin_exam_show','id')
            ->addIdentifier('topic','admin_topic_index','topicId')
            ->add('year','year')
        ;

        return $this->render('admin/exam/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'userData' => $userData,
            'table' => $table->render(),
            'rows' => ($rows/20),
            'currentPage' => $offset
        ]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function show(int $id):string
    {
        $object = $this->getRepositoryManager()->find(Exam::class, $id);


        $this->adminMenu->createMenu();
        $userData = [];

        $permissions = $this->repository->findAll(RolePermission::class);

        $table = new TableType($this->getView());
        $table
            ->configureComponent(Topic::class)
            ->setData($object->getTopic())
            ->setCaption('Thema')
            ->add('title')
            ->add('description')
        ;

        if(!array_filter((array)$object))
        {
            $this->setFlash('exam_not_found','danger');
            $this->response->redirectToRoute(302,'admin_exam_index');
        }

        return $this->render('admin/exam/show.html',[
            'adminMenu' => $this->adminMenu->render(),
            'object' => $object,
            'userData' => $userData,
            'table' => $table->render()
        ]);
    }

}