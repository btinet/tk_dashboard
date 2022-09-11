<?php

namespace App\Controller;


use App\Entity\Exam;
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

    public function index ()
    {
        $this->response->redirectToRoute('302','exam_index');
    }

    public function search()
    {
        if($this->request->isFormSubmitted() and $this->request->isPostRequest())
        {
            $queryString = $this->request->getFieldAsString('search');
            $result = [];
            if(!empty($queryString))
            {
                $result = $this->repository->search($queryString,Exam::class,['year' => 'desc']);
            }

            $mainMenu = new MenuBuilder();
            $mainMenu->createMenu();


            return $this->render('app/search_result.html',[
                'results' => $result,
                'queryString' => $queryString,
                'mainMenu' => $mainMenu->render(),
            ]);
        }
        $this->response->redirectToRoute('302','exam_index');
    }

}
