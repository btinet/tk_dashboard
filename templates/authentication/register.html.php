<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object|null $meta enthält Meta-Daten der Website
 * @var object $response enthält Response-Daten des Controllers
 * @var object $mainMenu enthält die Hauptnavigation"
 * @var Session $session Session-Objekt
 * @var Config $trans TranslationConfig-Objekt
 * @var array|false $userData Formulardaten des Benutzers
 * @var int $lastError Fehlernummer
 */

use Core\Component\ConfigComponent\Config;
use Core\Component\SessionComponent\Session;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.minimal.html',
    [
        'current_school_subject_id' => 0
    ]
);

?>

<?php $this->start('header') ?>
<p></p>
<?php $this->stop() ?>
<?php $this->start('main') ?>


<div class="row g-3 mb-3">
    <div class="col-12 col-md-4">

    </div>
    <div class="col-12 col-md-4">

        <?php if($lastError): ?>
            <div class="toast-container position-fixed top-0 end-0 p-3" style="position: absolute; z-index: 10000">
                <div id="liveToast" class="toast show text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Fehlermeldung</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <span><?=$trans->getConfig($lastError)?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="mt-2 mb-5 my-md-5">
            <h1>Registrieren</h1>
            <p class="lead">
                Registriere dich und reiche dein Präsentationsthema bequem und digital bei deinem Tutorium ein.
            </p>
        </div>


        <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Registrieren</div>

        <form class="row g-3 mb-4 needs-validation" method="post" novalidate>
            <div class="col-12">
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" value="<?=$userData?$userData['email']:false?>" placeholder="<?=$trans->getConfig('email')?>" required>
                    <label for="email"><?=$trans->getConfig('email')?></label>
                    <div class="invalid-feedback">
                        Bitte gib deine Kennung an.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="username" name="username" value="<?=$userData?$userData['username']:false?>" placeholder="<?=$trans->getConfig('username')?>" required>
                    <label for="username"><?=$trans->getConfig('username')?></label>
                    <div class="invalid-feedback">
                        Bitte gib deine Kennung an.
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="<?=$trans->getConfig('password')?>" required>
                    <label for="password"><?=$trans->getConfig('password')?></label>
                    <div class="invalid-feedback">
                        Bitte gib deine Kennung an.
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password_repeat" name="password_repeat" placeholder="<?=$trans->getConfig('password_repeat')?>" required>
                    <label for="password_repeat"><?=$trans->getConfig('password_repeat')?></label>
                    <div class="invalid-feedback">
                        Bitte gib deine Kennung an.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?=$userData?$userData['firstName']:false?>" placeholder="<?=$trans->getConfig('first_name')?>" required>
                    <label for="first_name"><?=$trans->getConfig('first_name')?></label>
                    <div class="invalid-feedback">
                        Bitte gib deine Kennung an.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?=$userData?$userData['lastName']:false?>" placeholder="<?=$trans->getConfig('last_name')?>" required>
                    <label for="first_name"><?=$trans->getConfig('last_name')?></label>
                    <div class="invalid-feedback">
                        Bitte gib deine Kennung an.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label for="user_locale" class="form-label"><?=$trans->getConfig('user_locale')?></label>
                <select class="form-select" id="user_locale" name="user_locale" aria-label="<?=$trans->getConfig('user_locale')?>">
                    <option selected>auswählen</option>
                    <option value="de">Deutsch</option>
                    <option value="en">Englisch</option>
                </select>
                <div class="invalid-feedback">
                    Bitte gib deine Kennung an.
                </div>
            </div>
            <div class="col-12">
                <span class=""></span>
            </div>
            <input type="hidden" id="csrf_token" name="csrf_token" value="<?=$session->get('csrf_token')?>">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Registrieren</button>
                <button type="reset" class="btn btn-light border">Zurücksetzen</button>
            </div>
        </form>
        <div class="row g-3">
            <div class="col-12">
                <a href="<?=$response->generateUrlFromRoute('authentication_login')?>">Stattdessen anmelden?</a>
            </div>
        </div>

    </div>
</div>
<?php $this->stop() ?>
