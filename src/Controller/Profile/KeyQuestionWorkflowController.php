<?php

namespace App\Controller\Profile;

use App\Entity\Exam;
use App\Entity\ExamHasExamStatus;
use App\Entity\ExamHasSchoolSubject;
use App\Entity\ExamStatus;
use App\Entity\SchoolSubject;
use App\Entity\Topic;
use App\Entity\User;
use App\Entity\UserHasExam;
use App\Entity\UserRole;
use App\Menu\MenuBuilder;
use App\Repository\UserExamRepository;
use App\Repository\UserRoleRepository;
use ArrayObject;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Component\MenuComponent\AbstractMenu;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;
use PDOException;

class KeyQuestionWorkflowController extends AbstractController
{

    protected AbstractRepositoryFactory $repository;

    private AbstractMenu $adminMenu;

    public function __construct()
    {
        parent::__construct();
        $this->repository = $this->getRepositoryManager(UserRole::class);
        $mainMenu = new MenuBuilder();
        $this->getView()->addData([
            'mainMenu' => $mainMenu->createMenu()->render(),
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
     * @return string|void
     */
    public function newKeyQuestion()
    {

        if($this->session->getUser())
        {

            $sr = $this->getRepositoryManager(SchoolSubject::class);
            $schoolSubjects = $sr->findAll();
            $userExamRepository = new UserExamRepository();
            $roleRepository = new UserRoleRepository();

            $supervisorList = [];

            if($supervisors = $roleRepository->findSupervisorsByLoad())
            {
                foreach ($supervisors as $supervisor)
                {
                    $attribs = $supervisor->getRoleAtrribs();
                    $supervisorList[] = ($attribs['supervise']['supervise_enable'] and $attribs['supervise']['pupil_amount'] < $count = $userExamRepository->countSupervisorLoad($supervisor->getId()))?:$supervisor;
                }
                uasort($supervisorList,Array ( $this, 'sorting'));
            }

            return $this->render('approval_process/new_start_form.html',[
                'subjects' => $schoolSubjects,
                'supervisors' => $supervisorList,
                'isNew' => true
            ]);
        }
        $this->setFlash('key_question_locked','danger');
        $this->response->redirectToRoute(302,'user_profile_index');
    }

    /**
     * @param int $examId
     * @return string|void
     */
    public function copyKeyQuestion(int $examId)
    {
        $er = $this->getRepositoryManager(Exam::class);
        $exam = $er->find($examId);
        if($this->session->getUser())
        {
            $userExamRepository = new UserExamRepository();
            $roleRepository = new UserRoleRepository();

            $supervisorList = [];

            if($supervisors = $roleRepository->findSupervisorsByLoad())
            {
                foreach ($supervisors as $supervisor)
                {
                    $attribs = $supervisor->getRoleAtrribs();
                    $supervisorList[] = ($attribs['supervise']['supervise_enable'] and $attribs['supervise']['pupil_amount'] < $count = $userExamRepository->countSupervisorLoad($supervisor->getId()))?:$supervisor;
                }
                uasort($supervisorList,Array ( $this, 'sorting'));
            }

            return $this->render('approval_process/claim_start_form.html',[
                'exam' => $exam,
                'supervisors' => $supervisorList,
                'isNew' => true
            ]);
        }
        $this->setFlash('key_question_locked','danger');
        $this->response->redirectToRoute(302,$this->generateUrlFromRoute('exam_show',[$exam->getId()]),true);
    }

    protected function sorting($a,$b): int
    {
        if($a instanceof User and $b instanceof User)
        {
            return strcmp($a->getLastName(true),$b->getLastName(true));
        }
        return 0;
    }

    /**
     * @param int $examId
     * @return string|void
     */
    public function claimKeyQuestion(int $examId)
    {
        $exam = $this->repository->setEntity(Exam::class)->find($examId);
        if(date('Y') >= ($exam->getYear()+3) and !$exam->getUser() and $this->session->getUser())
            {
                $userExamRepository = new UserExamRepository();
                $roleRepository = new UserRoleRepository();

                $supervisorList = [];

                if($supervisors = $roleRepository->findSupervisorsByLoad())
                {
                    foreach ($supervisors as $supervisor)
                    {
                        $attribs = $supervisor->getRoleAtrribs();
                        $supervisorList[] = ($attribs['supervise']['supervise_enable'] and $attribs['supervise']['pupil_amount'] < $count = $userExamRepository->countSupervisorLoad($supervisor->getId()))?:$supervisor;
                    }

                    uasort($supervisorList,Array ( $this, 'sorting'));
                }

                return $this->render('approval_process/claim_start_form.html',[
                    'exam' => $exam,
                    'supervisors' => $supervisorList,
                    'isNew' => false
                ]);
            }
        $this->setFlash('key_question_locked','danger');
        $this->response->redirectToRoute(302,$this->generateUrlFromRoute('exam_show',[$exam->getId()]),true);
    }


    public function transferKeyQuestion()
    {
        $exam = $this->repository->setEntity(Exam::class)->find($this->request->getFieldAsString('exam_id'));

        if($this->request->isFormSubmitted() and $this->request->isPostRequest() and !$exam->getUser())
        {
            if(!is_numeric($this->request->getFieldAsString('supervisor')))
            {
                $this->setFlash('no_supervisor_available');
                $this->response->redirectToRoute(302,$this->generateUrlFromRoute('exam_show',[$exam->getId()]),true);
            }
            $user = $this->session->getUser();
            $topic = $this->repository->setEntity(Topic::class)->findOneBy(['title' => $this->request->getFieldAsString('topic')]);
            $mainSubject = $this->repository->setEntity(SchoolSubject::class)->findOneBy(['label' => $this->request->getFieldAsString('school_subject_1')]);
            $secondarySubject = $this->repository->setEntity(SchoolSubject::class)->findOneBy(['label' => $this->request->getFieldAsString('school_subject_2')]);

            $userHasExam = new UserHasExam();
            $entityManager = new EntityManager();

            $userHasExam->setUserId($user->getId());
            $userHasExam->setKeyQuestion($this->request->getFieldAsString('key_question'));
            $userHasExam->setTopicId($topic->getId());
            $userHasExam->setMainSubjectId($mainSubject->getId());
            $userHasExam->setSecondarySubjectId($secondarySubject->getId());
            $userHasExam->setSupervisorId($this->request->getFieldAsString('supervisor'));



            $userExamId = $entityManager->persist($userHasExam);

            $status = $this->repository->setEntity(ExamStatus::class)->findOneBy(['label' => 'clearance']);

            $examStatus = new ExamHasExamStatus();

            $examStatus->setInfo("Antrag angelegt");
            $examStatus->setUserExamId($userExamId);
            $examStatus->setSupervisorId($user->getId());
            $examStatus->setExamStatusId($status->getId());

            $entityManager->persist($examStatus);

            $exams = $this->repository->setEntity(ExamHasSchoolSubject::class)->findBy(['exam_id' => $this->request->getFieldAsString('exam_id')]);

            foreach ($exams as $examObject)
            {
                $examObject->setUserId($user->getid());

                $entityManager->persist($examObject,$examObject->getId());
            }

        }
        $this->setFlash('key_question_send_to_clearance');
        $this->response->redirectToRoute(302,'user_profile_index');
    }

    public function createKeyQuestion()
    {

        if($this->request->isFormSubmitted() and $this->request->isPostRequest())
        {
            if(!is_numeric($this->request->getFieldAsString('supervisor')))
            {
                $this->setFlash('no_supervisor_available');
                $this->response->redirectToRoute(302,'user_profile_index');
            }
            $user = $this->session->getUser();
            $mainSubject = $this->repository->setEntity(SchoolSubject::class)->find($this->request->getFieldAsString('school_subject_1'));
            $secondarySubject = $this->repository->setEntity(SchoolSubject::class)->find($this->request->getFieldAsString('school_subject_2'));

            $userHasExam = new UserHasExam();
            $entityManager = new EntityManager();

            $userHasExam->setUserId($user->getId());
            $userHasExam->setKeyQuestion($this->request->getFieldAsString('key_question'));
            $userHasExam->setTopicId($this->request->getFieldAsString('topic'));
            $userHasExam->setMainSubjectId($mainSubject->getId());
            $userHasExam->setSecondarySubjectId($secondarySubject->getId());
            $userHasExam->setSupervisorId($this->request->getFieldAsString('supervisor'));



            $userExamId = $entityManager->persist($userHasExam);

            $status = $this->repository->setEntity(ExamStatus::class)->findOneBy(['label' => 'clearance']);

            $examStatus = new ExamHasExamStatus();

            $examStatus->setInfo("Antrag angelegt");
            $examStatus->setUserExamId($userExamId);
            $examStatus->setSupervisorId($user->getId());
            $examStatus->setExamStatusId($status->getId());

            $entityManager->persist($examStatus);

        }
        $this->setFlash('key_question_send_to_clearance');
        $this->response->redirectToRoute(302,'user_profile_index');
    }

}
