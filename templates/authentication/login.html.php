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

        <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Login</div>

        <form class="row g-3 mb-4" method="post">
            <div class="col-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Benutzername" required>
                    <label for="username">Benutzername</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Passwort" required>
                    <label for="password">Passwort</label>
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
                <a href="#">Stattdessen registrieren?</a>
            </div>
        </div>

    </div>
</div>
<?php $this->stop() ?>
