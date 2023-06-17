<?php


namespace App\Controller\Admin;

use App\Entity\Exam;
use App\Entity\ExamStatus;
use App\Entity\SchoolSubject;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
use App\Repository\ExamRepository;
use App\Type\TableType;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Component\MenuComponent\AbstractMenu;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class ExamStatusCrudController extends AbstractController
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
        $this->schoolSubjects = $this->getRepositoryManager(SchoolSubject::class)->findAll( ['label' => 'asc']);
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
        ]);

        $this->denyAccessUnlessHasPermission('show_exam_status');
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
                    $result = $em->remove(ExamStatus::class,$id);
                    if($result == 1)
                    {
                        $this->setFlash($result);
                    } else {
                        $this->setFlash($result,'warning');
                    }

                }
                $this->response->redirectToRoute(302,'admin_exam_status_index');
            }
        }

        $table = new TableType($this->getView());
        $table
            ->configureComponent(ExamStatus::class)
            ->setData($this->getRepositoryManager(ExamStatus::class)->findAll(['label'=>'asc']))
            ->setCaption('Prüfungsstatus')
            ->addIdentifier('label', 'admin_exam_status_index', 'id')
            ->add('created','date')
            ->add('updated','date');

        return $this->render('admin/exam_status/index.html', [
            'adminMenu' => $this->adminMenu->render(),
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
            $entity = new ExamStatus();

            if (0 === $em->isUnique('label', $this->request->getFieldAsString('label'), $this->getRepositoryManager(ExamStatus::class))) {
                $entity->setLabel($this->request->getFieldAsString('label'));
                $em->persist($entity);

            }
        }
        $this->response->redirectToRoute(302, 'admin_exam_status_index');
    }

}
