<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var Object $adminMenu Set of menu objects
 * @var Object $trans Translation object
 * @var Session $session Session-Objekt
 * @var Object $objects Translation object
 * @var array|false $userData Formulardaten des Benutzers
 */


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
    <div></div>
    <div class="col-12 col-md-4">

    </div>

    <div class="col-12 col-md-4">
        <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3"><?=$trans->getConfig('roles')?></div>

        <div class="mb-3 d-flex justify-content-start">
            <a href="<?=$response->generateUrlFromRoute('admin_role_index')?>" class="btn btn-light link-primary me-2">Übersicht</a>
            <button role="button" form="role_form" type="submit" class="btn btn-primary">Speichern</button>
        </div>

        <form method="post" id="role_form" class="row g-3 mb-4 needs-validation" novalidate>
            <div class="col-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="label" name="label" value="<?=$userData?$userData['label']:false?>" placeholder="<?=$trans->getConfig('label')?>" required>
                    <label for="label"><?=$trans->getConfig('label')?></label>
                    <div class="invalid-feedback">
                        Bitte gib eine Bezeichnung ein.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label class="form-label" for="description"><?=$trans->getConfig('description')?></label>
                <textarea class="form-control" id="description" rows="4" name="description" placeholder="<?=$trans->getConfig('description')?>" required><?=$userData?$userData['description']:false?></textarea>
                <div class="invalid-feedback">
                    Bitte gib eine Bezeichnung ein.
                </div>
            </div>
            <input type="hidden" id="csrf_token" name="csrf_token" value="<?=$session->get('csrf_token')?>">
        </form>

        <div class="mb-3 d-flex justify-content-start">
            <a href="<?=$response->generateUrlFromRoute('admin_role_index')?>" class="btn btn-light link-primary me-2">Übersicht</a>
            <button role="button" form="role_form" type="submit" class="btn btn-primary">Speichern</button>
        </div>

    </div>
</div>
<?php $this->stop() ?>
