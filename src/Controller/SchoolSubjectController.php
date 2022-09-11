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

}
