<?php

namespace App\Controller\Profile;

use App\Entity\Exam;
use App\Entity\ExamHasExamStatus;
use App\Entity\RolePermission;
use App\Entity\SchoolSubject;
use App\Entity\UserHasExam;
use App\Entity\UserRole;
use App\Entity\UserRoleHasRolePermission;
use App\Entity\UserRoleHasUser;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
use App\Menu\ProfileMenu;
use App\Repository\ExamRepository;
use App\Repository\UserRoleRepository;
use App\Type\TableType;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Component\MenuComponent\AbstractMenu;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class ProfileController extends AbstractController
{

    protected AbstractRepositoryFactory $repository;

    /**
     * @var array|false|string
     */
    private $schoolSubjects;
    private AbstractMenu $adminMenu;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new UserRoleRepository();
        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();
        $this->schoolSubjects = $this->getRepositoryManager()->findAll(SchoolSubject::class,['label' => 'asc']);
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
            'repository' => $this->repository
        ]);

        $this->denyAccessUnlessHasPermission('show_profile');
    }

    public function index(): string
    {

        $user = $this->session->getUser();
        $profileMenu = new ProfileMenu($user);
        $profileMenu->createMenu();

        $foreignExams = false;

        $attribs = [];

        if($this->session->UserHasPermission('has_supervisor'))
        {
            if (null === $attribs = $user->getRoleAtrribs() or !array_key_exists('supervise',$attribs))
            {
                $attribs['supervise']['pupil_amount']=null;
                $attribs['supervise']['supervise_enable']=false;
            }

            $examRepository = $this->repository->findBy(UserHasExam::class,['supervisor_id'=> $user->getId()]);

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

        $examCount = $this->repository->countDistinctBy(Exam::class,'key_question');
        $userExam = $this->repository->findBy(UserHasExam::class,['user_id'=> $user->getId()]);

        return $this->render('profile/index.html',[
            'userExam' => $userExam,
            'foreignExams' => $foreignExams,
            'examCount' => $examCount,
            'attribs' => $attribs,
            'menu' => $profileMenu->render(),
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

        $exam = $this->repository->find(UserHasExam::class,$userExamId);

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
            $userRoleHasUser = $this->getRepositoryManager()->findOneBy(UserRoleHasUser::class,[
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