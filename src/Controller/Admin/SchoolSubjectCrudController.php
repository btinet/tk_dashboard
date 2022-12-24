<?php

namespace App\Controller\Admin;

use App\Entity\RolePermission;
use App\Entity\SchoolSubject;
use App\Entity\SchoolSubjectType;
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

class SchoolSubjectCrudController extends AbstractController
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

        $this->denyAccessUnlessHasPermission('show_school_subject');
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
                    $em->remove(SchoolSubject::class,$id);
                }
            }
        }

        $table = new TableType($this->getView());
        $table
            ->configureComponent(SchoolSubject::class)
            ->setData($this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc'],20))
            ->setCaption('Fächer')
            ->addIdentifier('label','admin_school_subject_index','id')
            ->add('abbr')
            ->addIdentifier('schoolSubjectType','admin_school_subject_type_index','schoolSubjectTypeId')
            ->add('created','date')
            ->add('updated','date')
        ;

        return $this->render('admin/school_subject/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'objects' => $this->getRepositoryManager()->findAll(SchoolSubjectType::class),
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
            $entity = new SchoolSubject();

            if(0 === $em->isUnique(SchoolSubject::class,'label', $this->request->getFieldAsString('label'),$this->getRepositoryManager()))
            {
                $entity->setLabel($this->request->getFieldAsString('label'));
                $entity->setAbbr($this->request->getFieldAsString('abbr'));
                $entity->setSchoolSubjectTypeId($this->request->getFieldAsString('school_subject_type_id'));
                $em->persist($entity);

                $this->response->redirectToRoute(302,'admin_school_subject_index');
            }
        }
        $this->response->redirectToRoute(302,'admin_school_subject_index');
    }

}
