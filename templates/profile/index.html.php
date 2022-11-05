<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var Object $adminMenu Set of menu objects
 * @var Object $trans Translation object
 * @var Object $objects Translation object
 * @var Session $session Session-Objekt
 * @var array|false $userData Formulardaten des Benutzers
 * @var array $table Tabledata for current entitx
 * @var int $rows row count of current entity
 * @var int $currentPage current offset
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

    <div class="col-12 col-md-3">
        <div class="d-none d-md-block">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="h6 fw-light text-muted text-uppercase mb-0 ps-3"><?=$trans->getConfig('profile')?></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-9">
        Content
    </div>

</div>

<?php $this->stop() ?>
