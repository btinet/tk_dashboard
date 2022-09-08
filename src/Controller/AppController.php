<?php

namespace App\Controller;

use App\Entity\Student;
use App\Menu\MenuBuilder;
use App\Repository\StudentRepository;
use Core\Controller\AbstractController;

class AppController extends AbstractController
{

    /**
     * @param int|null $i number given from the route
     * @return string
     */
    public function index(int $i = null): string
    {
        $luckyNumber = rand(1, 99);
        $btn = $this->generateUrlFromRoute('app_index_id',[$luckyNumber]);
        $number = null !== $i ? $i : false;
        $students = $this->getRepositoryManager()->findAll(Student::class);
        $studentRepository = new StudentRepository();


        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();

        /**
         * Meta-Daten müssen nicht manuell der render-Methode übergeben werden.
         * Diese werden automatisch mit der abstrakten Controller-Klasse übergeben.
         */
        return $this->render('lucky_number/index.html', [
            'number' => $number,
            'btn' => $btn,
            'students' => $students,
            'mainMenu' => $mainMenu->render(),
        ]);
    }

}
