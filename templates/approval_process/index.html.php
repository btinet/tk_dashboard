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
$this->layout('_layout.profile.html',
    [
        'current_school_subject_id' => 0
    ]
);

?>

<?php $this->start('main') ?>


<div class="row g-3 mb-3">
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-body border-1">
                <h1 class="h5">Persönliches Konto</h1>
                <div class="d-flex justify-content-center align-items-start flex-column">
                    <span class="small">Name</span>
                    <?=$session->getUser()->getFirstname()?> <?=$session->getUser()->getLastName()?>
                    <span class="small mt-2">E-Mail-Adresse</span>
                    <span class="text-truncate"><?=$session->getUser()->getEmail()?></span>
                    <span class="small mt-2">Mitglied seit</span>
                    <?php $date = DateTime::createFromFormat('Y-m-d H:i:s',$session->getUser()->getCreated())?>
                    <?=$date->format('d.m.Y')?>
                </div>
            </div>
            <div class="list-group list-group-flush">
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <b>Kurs</b>
                    <b>Tutor:in</b>
                </div>
                <?php foreach ($session->getUser()->getGroup() as $group): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="#" class="btn btn-sm btn-light">
                            <?=$group->getLabel()?>
                        </a>
                        <?php if($group->getTutor()): ?>
                            <a href="#"><?=$group->getTutor()->getLastName()?></a>
                        <?php endif;?>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>


    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-body">
                <h2 class="h5">Meine Prüfungsthemen</h2>
            </div>
        </div>
    </div>

</div>

<?php $this->stop() ?>
