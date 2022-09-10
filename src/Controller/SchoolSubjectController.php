<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Entity\SchoolSubject;
use App\Menu\MenuBuilder;
use App\Repository\ExamRepository;
use Core\Controller\AbstractController;

class SchoolSubjectController extends AbstractController
{

    private ExamRepository $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new ExamRepository();
    }

    /**
     * @return string
     */
    public function index(): string
    {
        return '';
    }

    /**
     * @param int $id
     * @return string
     */
    public function show(int $id): string
    {
        $schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
        $examsByMainSchoolSubject = $this->repository->findBySubject($id,1, Exam::class, ['year' => 'desc']);
        $examsBySecondarySchoolSubject = $this->repository->findBySubject($id,0, Exam::class, ['year' => 'desc']);


        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();

        /**
         * Meta-Daten müssen nicht manuell der render-Methode übergeben werden.
         * Diese werden automatisch mit der abstrakten Controller-Klasse übergeben.
         */
        return $this->render('school_subject/index.html', [
            'schoolSubjects' => $schoolSubjects,
            'examsByMainSchoolSubject' => $examsByMainSchoolSubject,
            'examsBySecondarySchoolSubject' => $examsBySecondarySchoolSubject,
            'mainMenu' => $mainMenu->render(),
            'current_school_subject_id' => $id
        ]);
    }

}
