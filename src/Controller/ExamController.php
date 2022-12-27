<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Entity\SchoolSubject;
use App\Entity\SchoolSubjectType;
use App\Menu\MenuBuilder;
use App\Repository\ExamRepository;
use App\Repository\GenericRepository;
use App\Repository\SchoolSubjectRepository;
use Core\Controller\AbstractController;

class ExamController extends AbstractController
{

    private ExamRepository $repository;
    private SchoolSubjectRepository $subjectRepository;
    protected array $schoolSubjects;

    public function __construct()
    {
        parent::__construct();
        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();
        $this->repository = new ExamRepository();
        $this->subjectRepository = new SchoolSubjectRepository();
        $this->schoolSubjects = $this->subjectRepository->findAll(['label' => 'asc']);
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
        $exams = []; //$this->repository->findExamsGroupByKeyQuestion( Exam::class, ['year' => 'desc']);
        $examTypes = $this->getRepositoryManager(SchoolSubjectType::class)->findAll();

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
        $examsByMainSchoolSubject = $this->repository->findBySubject($id,1, ['year' => 'desc']);
        $examsBySecondarySchoolSubject = $this->repository->findBySubject($id,0,  ['year' => 'desc']);

        return $this->render('exam/list.html', [
            'examsByMainSchoolSubject' => $examsByMainSchoolSubject,
            'examsBySecondarySchoolSubject' => $examsBySecondarySchoolSubject,
            'current_school_subject_id' => $id,
            'currentSchoolSubject' => $this->subjectRepository->find($id)
        ]);
    }

    /**
     * @param int $examId
     * @return string
     */
    public function show(int $examId): string
    {
        $exam = $this->getRepositoryManager(Exam::class)->find($examId);

        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();

        return $this->render('exam/show.html', [
            'exam' => $exam,
        ]);
    }

}
