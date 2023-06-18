<?php

namespace App\Controller\Workflow;

use App\Entity\ExamHasExamStatus;
use App\Entity\ExamStatus;
use App\Repository\GenericRepository;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Controller\AbstractController;

class GrantWorkflow extends AbstractController
{

    private GenericRepository $repository;

    public function __construct()
    {
        parent::__construct();
        $this->denyAccessUnlessHasPermission('update_exam_status');
        $this->repository = new GenericRepository(ExamStatus::class);
    }


    public function updateWorkflow()
    {

        if($this->request->isFormSubmitted() and $this->request->isPostRequest())
        {
            $examId = $this->request->getFieldAsString('exam_id');
            $examStatus = $this->request->getFieldAsString('exam_status');
            $info = $this->request->getFieldAsString('info');

            $em = new EntityManager();

            if($examStatus = $this->repository->findOneBy(['label' => $examStatus]))
            {
                $workflowObject = new ExamHasExamStatus();
                $workflowObject
                    ->setUserExamId($examId)
                    ->setSupervisorId($this->session->getUser()->getId())
                    ->setInfo($info)
                    ->setExamStatusId($examStatus->getId())
                ;

                $em->persist($workflowObject);
                $this->setFlash('key_question_send_to_revision');
            }

        }

        $this->response->redirectToRoute(302,'user_profile_index');
    }

}
