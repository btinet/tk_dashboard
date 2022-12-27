<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Entity\SchoolSubject;
use App\Entity\SchoolSubjectType;
use App\Menu\MenuBuilder;
use App\Repository\ExamRepository;
use App\Repository\GenericRepository;
use Core\Controller\AbstractController;

class ExamController extends AbstractController
{

    private GenericRepository $repository;
    protected array $schoolSubjects;

    public function __construct()
    {
        parent::__construct();

        $this->repository = $this->getRepositoryManager(SchoolSubjectType::class);
        $mainMenu = new MenuBuilder();

        $this->getView()->addData([
            'mainMenu' => $mainMenu->createMenu()->render(),
            'repository' => $this->repository
        ]);

        if(!$this->session->getUser()){$this->response->redirectToRoute(302,'authentication_login');}
    }

    /**
     * @return string
     */
    public function index(): string
    {
        $subjectTypes = $this->repository->setEntity(SchoolSubjectType::class)->findAll();

        /**
         * Meta-Daten müssen nicht manuell der render-Methode übergeben werden.
         * Diese werden automatisch mit der abstrakten Controller-Klasse übergeben.
         */
        return $this->render('exam/index.html', [
            'subjectTypes' => $subjectTypes
        ]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function list(int $id): string
    {
        $examRepository = new ExamRepository();
        $examsByMainSchoolSubject = $examRepository->findBySubject($id,1, ['year' => 'desc']);
        $examsBySecondarySchoolSubject = $examRepository->findBySubject($id,0,  ['year' => 'desc']);

        return $this->render('exam/list.html', [
            'examsByMainSchoolSubject' => $examsByMainSchoolSubject,
            'examsBySecondarySchoolSubject' => $examsBySecondarySchoolSubject,
            'current_school_subject_id' => $id,
            'currentSchoolSubject' => $this->repository->setEntity(SchoolSubject::class)->find($id)
        ]);
    }

    /**
     * @param int $examId
     * @return string
     */
    public function show(int $examId): string
    {
        $exam = $this->repository->setEntity(Exam::class)->find($examId);

        return $this->render('exam/show.html', [
            'exam' => $exam,
        ]);
    }

}
