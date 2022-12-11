<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Entity\SchoolSubject;
use App\Entity\SchoolSubjectType;
use App\Menu\MenuBuilder;
use App\Repository\ExamRepository;
use Core\Controller\AbstractController;

class ExamController extends AbstractController
{

    private ExamRepository $repository;
    protected $schoolSubjects;

    public function __construct()
    {
        parent::__construct();
        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();
        $this->repository = new ExamRepository();
        $this->schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
            ]);
        if(!$this->session->getUser()){$this->response->redirectToRoute(302,'authentication_login');}
    }

    /**
     * @return string
     */
    public function index(): string
    {
        $schoolSubjects = $this->schoolSubjects;
        $exams = []; //$this->repository->findExamsGroupByKeyQuestion( Exam::class, ['year' => 'desc']);
        $examTypes = $this->repository->findAll(SchoolSubjectType::class);

        /**
         * Meta-Daten müssen nicht manuell der render-Methode übergeben werden.
         * Diese werden automatisch mit der abstrakten Controller-Klasse übergeben.
         */
        return $this->render('exam/index.html', [
            'exams' => $exams,
            'subjectTypes' => $examTypes
        ]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function list(int $id): string
    {
        $examsByMainSchoolSubject = $this->repository->findBySubject($id,1, Exam::class, ['year' => 'desc']);
        $examsBySecondarySchoolSubject = $this->repository->findBySubject($id,0, Exam::class, ['year' => 'desc']);

        return $this->render('exam/list.html', [
            'examsByMainSchoolSubject' => $examsByMainSchoolSubject,
            'examsBySecondarySchoolSubject' => $examsBySecondarySchoolSubject,
            'current_school_subject_id' => $id,
            'currentSchoolSubject' => $this->repository->find(SchoolSubject::class,$id)
        ]);
    }

    /**
     * @param int $examId
     * @return string
     */
    public function show(int $examId): string
    {
        $exam = $this->repository->find(Exam::class,$examId);

        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();

        return $this->render('exam/show.html', [
            'exam' => $exam,
        ]);
    }

}
