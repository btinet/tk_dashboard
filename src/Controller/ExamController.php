<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Entity\SchoolSubject;
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
        $this->repository = new ExamRepository();
        $this->schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
    }

    /**
     * @return string
     */
    public function index(): string
    {
        $schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
        $exams = $this->repository->findExamsGroupByKeyQuestion( Exam::class, ['year' => 'desc']);

        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();

        /**
         * Meta-Daten müssen nicht manuell der render-Methode übergeben werden.
         * Diese werden automatisch mit der abstrakten Controller-Klasse übergeben.
         */
        return $this->render('exam/index.html', [
            'schoolSubjects' => $schoolSubjects,
            'exams' => $exams,
            'mainMenu' => $mainMenu->render(),
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

        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();

        return $this->render('exam/list.html', [
            'schoolSubjects' => $this->schoolSubjects,
            'examsByMainSchoolSubject' => $examsByMainSchoolSubject,
            'examsBySecondarySchoolSubject' => $examsBySecondarySchoolSubject,
            'mainMenu' => $mainMenu->render(),
            'current_school_subject_id' => $id
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
            'schoolSubjects' => $this->schoolSubjects,
            'exam' => $exam,
            'mainMenu' => $mainMenu->render(),
        ]);
    }

}