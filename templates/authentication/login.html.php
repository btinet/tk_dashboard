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
 * @var int $lastError Fehlernummer
 */

use Core\Component\ConfigComponent\Config;
use Core\Component\SessionComponent\Session;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.standard.html',
    [
        'current_school_subject_id' => 0
    ]
);

?>

<?php $this->start('main') ?>


<div class="row g-3 mb-3">
    <div class="col-12 col-md-4">

    </div>
    <div class="col-12 col-md-4">

        <div class="mt-2 mb-5 my-md-5">
            <h1>Anmelden</h1>
            <p class="lead">
                Melde dich an und verwalte dein Präsentationsthema bequem und digital.
            </p>
        </div>

        <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Login</div>

        <form class="row g-3 mb-4 needs-validation" method="post" novalidate>
            <div class="col-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="username" name="username" placeholder="<?=$trans->getConfig('username')?>" required>
                    <label for="username"><?=$trans->getConfig('username')?></label>
                    <div class="invalid-feedback">
                        Bitte gib deine Kennung an.
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Passwort" required>
                    <label for="password">Passwort</label>
                    <div class="invalid-feedback">
                        Bitte gib dein Passwort an.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a href="#" class="small">Passwort vergessen?</a>
            </div>
            <input type="hidden" id="csrf_token" name="csrf_token" value="<?=$session->get('csrf_token')?>">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Anmelden</button>
                <button type="reset" class="btn btn-light border">Zurücksetzen</button>
            </div>
        </form>
        <div class="row g-3">
            <div class="col-12">
                <a href="<?=$response->generateUrlFromRoute('authentication_register')?>">Stattdessen registrieren?</a>
            </div>
        </div>

    </div>
</div>
<?php $this->stop() ?>
