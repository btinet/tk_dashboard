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

class SchoolSubjectTypeCrudController extends AbstractController
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

        $this->denyAccessUnlessHasPermission('show_school_subject_type');
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
                    $result = $em->remove(SchoolSubjectType::class,$id);
                    if($result == 1)
                    {
                        $this->setFlash($result);
                    } else {
                        $this->setFlash($result,'warning');
                    }

                }
                $this->response->redirectToRoute(302,'admin_school_subject_type_index');
            }
        }

        $table = new TableType($this->getView());
        $table
            ->configureComponent(SchoolSubjectType::class)
            ->setData($this->getRepositoryManager(SchoolSubjectType::class)->findAll(['label' => 'asc']))
            ->setCaption('Fachbereiche')
            ->addIdentifier('label', 'admin_school_subject_type_index', 'id')
            ->add('description')
            ->add('created','date')
            ->add('updated','date');

        return $this->render('admin/school_subject_type/index.html', [
            'adminMenu' => $this->adminMenu->render(),
            'objects' => $this->getRepositoryManager(SchoolSubjectType::class)->findAll(),
            'userData' => $userData,
            'table' => $table->render()
        ]);
    }

    public function new()
    {
        $this->adminMenu->createMenu();
        $userData = [];

        if ($this->request->isFormSubmitted() and $this->request->isPostRequest()) {
            $em = new EntityManager();
            $entity = new SchoolSubjectType();

            if (0 === $em->isUnique('label', $this->request->getFieldAsString('label'), $this->getRepositoryManager(SchoolSubjectType::class))) {
                $entity->setLabel($this->request->getFieldAsString('label'));
                $entity->setDescription($this->request->getFieldAsString('description'));
                $em->persist($entity);

                $this->response->redirectToRoute(302, 'admin_school_subject_type_index');
            }
        }
        $this->response->redirectToRoute(302, 'admin_school_subject_type_index');
    }

}
