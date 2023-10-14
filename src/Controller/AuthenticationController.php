<?php

namespace App\Controller;

use App\Entity\SchoolSubject;
use App\Entity\User;
use App\Menu\MenuBuilder;
use App\Repository\ExamRepository;
use App\Repository\UserRepository;
use App\Service\EncryptionService;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Component\UserComponent\UserService;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class AuthenticationController extends AbstractController
{

    protected AbstractRepositoryFactory $repository;

    /**
     * @var array|false|string
     */
    private $schoolSubjects;

    public function __construct()
    {
        parent::__construct();
        $this->generateToken();
        $this->repository = new UserRepository();
        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();
        $this->schoolSubjects = [];
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
        ]);



    }

    public function login(): string
    {
        if($this->session->get('login')) $this->response->redirectToRoute(302,'app_index');

        $tryLoginLastError = null;

        if($this->request->isFormSubmitted() and $this->request->isPostRequest())
        {
            $encryptionService = new EncryptionService();

            $loginData = [
                'username' => $encryptionService->encryptString($this->request->getFieldAsString('username')),
                'password' => $this->request->getFieldAsString('password')
            ];

            if($loginData['username'] and $loginData['password']) {
                if (0 === ($tryLoginLastError = UserService::tryLogin($this->repository, $loginData))) {
                    $user = $this->repository->findOneBy(['username' => $loginData['username']]);
                    if ($user) {
                        $this->session->set('user', $user->getId());
                        $this->session->set('login', true);
                        $this->setFlash(200);
                    }

                    $this->response->redirectToRoute(302, 'app_index');
                }
            }
            $this->setFlash($tryLoginLastError,'danger');
            $this->response->redirectToRoute(302, 'authentication_login');
        }



        return $this->render('authentication/login.html',[
            'lastError' => $tryLoginLastError
        ]);

    }

    public function logout()
    {
        if($this->session->get('login')) $this->session->destroy();
        $this->response->redirectToRoute(302,'app_index');
    }

    public function register(): string
    {
        if($this->session->get('login')) $this->response->redirectToRoute(302,'app_index');

        $validationLastError = false;
        $userInputData = false;

        if($this->request->isPostRequest() and $this->request->isFormSubmitted())
        {
            $userInputData = [
                'username' => $this->request->getFieldAsString('username'),
                'password' => [
                    $this->request->getFieldAsString('password'),
                    $this->request->getFieldAsString('password_repeat')
                ],
                'email' => $this->request->getFieldAsString('email'),
                'firstName' => $this->request->getFieldAsString('first_name'),
                'lastName' => $this->request->getFieldAsString('last_name'),
                'isActive' => true,
                'language' => $this->request->getFieldAsString('user_locale')
            ];

            if(0 === ($validationLastError = UserService::validate(User::class, $this->repository, $userInputData))){
                $user = new User();
                $user->setUsername($userInputData['username']);
                $user->setEmail($userInputData['email']);
                $user->setPassword($userInputData['password'][0]);
                $user->setFirstName($userInputData['firstName']);
                $user->setLastName($userInputData['lastName']);
                $user->setIsActive(1);
                $user->setUserLocale($userInputData['language']);


               $rm = new EntityManager();
               if(false !== $result = $rm->persist($user))
               {
                   $user->setUserRoleId();
                   $this->response->redirectToRoute(302,'authentication_login');
               }
                $validationLastError = 500;
            }
        }

        return $this->render('authentication/register.html',[
            'lastError' => $validationLastError,
            'userData' => $userInputData
        ]);
    }

}
