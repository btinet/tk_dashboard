<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Entity\SchoolSubject;
use App\Menu\MenuBuilder;
use App\Repository\ExamRepository;
use Core\Controller\AbstractController;

class AppController extends AbstractController
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
        $schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
        $exams = $this->repository->findExamsGroupByKeyQuestion( Exam::class, ['year' => 'desc']);

        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();

        /**
         * Meta-Daten müssen nicht manuell der render-Methode übergeben werden.
         * Diese werden automatisch mit der abstrakten Controller-Klasse übergeben.
         */
        return $this->render('app/index.html', [
            'schoolSubjects' => $schoolSubjects,
            'exams' => $exams,
            'mainMenu' => $mainMenu->render(),
        ]);
    }

}
