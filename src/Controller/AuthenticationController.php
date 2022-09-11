<?php

namespace App\Controller;

use App\Entity\User;
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

    public function login()
    {
        /*
         * Formular-Array für den Login:
         */
        $loginData = [
            'username' => 'Benutzername',
            'password' => 'Passwort'
        ];

        // TODO: Login-Formular erstellen und verarbeiten
        UserService::tryLogin($this->repository,User::class,[]);

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
