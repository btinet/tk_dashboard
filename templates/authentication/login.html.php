<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object|null $meta enthält Meta-Daten der Website
 * @var object $response enthält Response-Daten des Controllers
 * @var object $mainMenu enthält die Hauptnavigation"
 * @var Session $session Session-Objekt
 */

use Core\Component\SessionComponent\Session;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.standard.html',
    [
        'meta'=>$meta,
        'response'=>$response,
        'mainMenu' => $mainMenu,
        'session' => $session,
    ]
);

?>

<?php $this->start('main') ?>
<div class="row g-3 mb-3">
    <div class="col-12 col-md-4">
        <div class="d-flex justify-content-between align-items-center mb-2">

        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Login</div>

        <form class="row g-3 mb-4">
            <div class="col-12">
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Anmelden</button>
                <button type="reset" class="btn btn-light border">Zurücksetzen</button>
            </div>
        </form>
        <a href="#">Stattdessen registrieren?</a>
    </div>
</div>
<?php $this->stop() ?>
