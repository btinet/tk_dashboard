<?php

namespace App\Controller\Profile;

use App\Entity\Exam;
use App\Entity\SchoolSubject;
use App\Menu\MenuBuilder;
use App\Repository\UserRoleRepository;
use Core\Component\MenuComponent\AbstractMenu;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class KeyQuestionWorkflowController extends AbstractController
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

        $this->denyAccessUnlessHasPermission('create_key_question');
    }

    public function index(): string
    {
        return $this->render('approval_process/index.html',[

        ]);
    }

    /**
     * @param int $examId
     * @return string|void
     */
    public function claimKeyQuestion(int $examId)
    {
        $exam = $this->repository->find(Exam::class,$examId);
        if(date('Y') >= ($exam->getYear()+3) and !$exam->getUser() and $this->session->getUser())
            {
                return $this->render('approval_process/claim_start_form.html',[
                    'exam' => $exam,
                ]);
            }
        $this->setFlash('key_question_locked','danger');
        $this->response->redirectToRoute(302,$this->generateUrlFromRoute('exam_show',[$exam->getId()]),true);
    }

}