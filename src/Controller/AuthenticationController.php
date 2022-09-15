<?php

namespace App\Controller;

use App\Entity\User;
use App\Menu\MenuBuilder;
use Core\Component\UserComponent\UserService;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class AuthenticationController extends AbstractController
{

    protected AbstractRepositoryFactory $repository;

    public function __construct()
    {
        parent::__construct();

        $this->repository = new AbstractRepositoryFactory();
    }

    public function login(): string
    {
        if($this->session->get('login')) $this->response->redirectToRoute(302,'app_index');

        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();

        $tryLoginLastError = null;

        if($this->request->isFormSubmitted() and $this->request->isPostRequest())
        {
            $loginData = [
                'username' => $this->request->getFieldAsString('username'),
                'password' => $this->request->getFieldAsString('password')
            ];

            if($loginData['username'] and $loginData['password']) {
                if (0 === ($tryLoginLastError = UserService::tryLogin($this->repository, User::class, $loginData))) {
                    $user = $this->repository->findOneBy(User::class, ['username' => $loginData['username']]);
                    if ($user) {
                        $this->session->set('user', $user['id']);
                        $this->session->set('login', true);
                    }
                    $this->response->redirectToRoute(302, 'app_index');
                }
            }


        }

        return $this->render('authentication/login.html',[
            'mainMenu' => $mainMenu->render(),
            'lastError' => $tryLoginLastError
        ]);

    }

    public function logout()
    {
        $this->session->destroy();
        $this->response->redirectToRoute('app_index');
    }

    public function register()
    {
        /*
         * Formular-Array für die Registrierung:
         */
        $loginData = [
            'username' => 'Benutzername',
            'password' => [
                'password' =>'Passwort',
                'passwordRetype' => 'Passwortwiederholung'
            ],
            'email' => 'E-Mail-Adresse',
            'firstName' => 'Vorname',
            'lastName' => 'Nachname'
        ];

        // TODO: Register-Formular erstellen und verarbeiten
        UserService::validate($this->repository,[]);
    }

}
