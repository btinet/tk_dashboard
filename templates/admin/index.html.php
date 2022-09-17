<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var Object $adminMenu Set of menu objects
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
        <div class="d-none d-md-block">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="h6 fw-light text-muted text-uppercase mb-0 ps-3">Menü</div>
            </div>

            <div class="collapse show" id="collapseExample">
                <?php $this->insert('app/list_group.html',['objects'=>$adminMenu, 'response'=>$response,]);
                ?>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8">
        <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Administration</div>
        <div class="rounded-3 border bg-light p-3">
            <h1>Dashboard</h1>
            <p>
                Das ist die Administrationsübersicht. Hier werden Kennungen, Rollen, Themen und vieles mehr verwaltet.
            </p>
        </div>

    </div>
</div>
<?php $this->stop() ?>
