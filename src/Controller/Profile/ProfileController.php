<?php

namespace App\Controller\Profile;

use App\Entity\UserHasExam;
use App\Entity\UserRoleHasUser;
use App\Menu\MenuBuilder;
use App\Menu\ProfileMenu;
use App\Repository\GenericRepository;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class ProfileController extends AbstractController
{

    protected AbstractRepositoryFactory $repository;

    public function __construct()
    {
        parent::__construct();

        $this->repository = new GenericRepository(UserHasExam::class);
        $mainMenu = new MenuBuilder();

        $this->getView()->addData([
            'mainMenu' => $mainMenu->createMenu()->render(),
            'repository' => $this->repository
        ]);

        /**
         * Access Control
         */
        $this->denyAccessUnlessHasPermission('show_profile');
    }

    /**
     * @return string
     */
    public function index(): string
    {

        $user = $this->session->getUser();
        $profileMenu = new ProfileMenu($user);

        $foreignExams = false;
        $attribs = [];

        if($this->session->UserHasPermission('has_supervisor'))
        {
            if (null === $attribs = $user->getRoleAtrribs() or !array_key_exists('supervise',$attribs))
            {
                $attribs['supervise']['pupil_amount']=null;
                $attribs['supervise']['supervise_enable']=false;
            }
            $examRepository = $this->repository->findBy(['supervisor_id'=> $user->getId()]);
            if($examRepository)
            {
                foreach ($examRepository as $exam)
                {
                    switch($exam->getStatus())
                    {
                        case 'clearance':
                            $foreignExams[] = $exam;
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        $userExam = $this->repository->findBy(['user_id'=> $user->getId()]);

        return $this->render('profile/index.html',[
            'userExam' => $userExam,
            'foreignExams' => $foreignExams,
            'attribs' => $attribs,
            'menu' => $profileMenu->createMenu()->render(),
        ]);
    }

    /**
     * @param int $userExamId id of current user exam
     * @return string html template
     */
    public function showExam(int $userExamId): string
    {
        $profileMenu = new ProfileMenu($this->session->getUser());
        $profileMenu->createMenu();

        $exam = $this->repository->find($userExamId);

        return $this->render('profile/show_exam.html',[
            'exam' => $exam,
            'menu' => $profileMenu->render(),
        ]);
    }

    public function saveSettings(): void
    {
        if($this->request->isFormSubmitted() and $this->request->isPostRequest())
        {
            $em = new EntityManager();

            $userRoleHasUser = $this->getRepositoryManager(UserRoleHasUser::class)->findOneBy([
                'userId' => $this->session->getUser()->getId(),
                'userRoleId' => 18
            ]);

            if($userRoleHasUser)
            {
                $attrib = $userRoleHasUser->getAttribsAsArray();
                $attrib['supervise']['pupil_amount'] = $this->request->getFieldAsString('pupil_amount');
                $attrib['supervise']['supervise_enable'] = $this->request->getFieldAsString('enable');

                $userRoleHasUser->setAttribs($attrib);

                $em->persist($userRoleHasUser,$userRoleHasUser->getId());
                $this->setFlash('role_updated');
            } else {
                $this->setFlash('role_not_found','danger');
            }

        }

        $this->response->redirectToRoute(302,'user_profile_index');
    }
}