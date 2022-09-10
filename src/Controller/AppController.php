<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Entity\SchoolSubject;
use App\Menu\MenuBuilder;
use Core\Controller\AbstractController;

class AppController extends AbstractController
{

    /**
     * @return string
     */
    public function index(): string
    {
        $schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
        $exams = $this->getRepositoryManager()->findAll(Exam::class,['year' => 'desc']);

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
