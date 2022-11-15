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
    /**
     * @var array|false|string
     */
    private $schoolSubjects;

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
