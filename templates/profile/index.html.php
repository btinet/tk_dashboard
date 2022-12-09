<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var Object $adminMenu Set of menu objects
 * @var Object $trans Translation object
 * @var Object $userExam Translation object
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

    <div class="col-12">
        <div class="card shadow-sm">
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

        </div>
    </div>


    <div class="col-12">
        <div class="row g-3">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="h5 mb-0">Meine Prüfungsthemen</h2>
                    </div>
                    <div class="list-group list-group-flush">
                        <?php if($userExam):?>
                            <?php foreach ($userExam as $exam):?>
                                <?php $date = DateTime::createFromFormat('Y-m-d H:i:s',$exam->getCreated())?>
                                <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start">
                                    <div>

                                        <div><?=$exam->getTopic()?></div>
                                        <div class="my-2">
                                            <span class="badge text-bg-primary"><?=$exam->getMainSchoolSubject()->getLabel()?></span>
                                            <span class="badge text-bg-light"><?=$exam->getSecondarySchoolSubject()->getLabel()?></span>
                                        </div>
                                        <a href="#" class="fw-bolder"><?=$exam->getKeyQuestion()?></a>
                                        <div class="small my-2 text-muted">am <?=$date->format('d.m.Y')?> erstellt</div>
                                        <span class="text-bg-primary badge"><?=$trans->getConfig($exam->getStatus())?></span>
                                        <span class="text-bg-warning badge"><?=$exam->getStatus()->getInfo()?></span>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php else:?>
                            <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start">
                                <span>Noch kein Prüfungsthema beantragt.</span>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <?php if($session->UserHasPermission('show_my_group')): ?>
                <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="h5 mb-0">Meine Kurse</h2>
                    </div>
                    <div class="list-group list-group-flush">
                    <?php foreach ($session->getUser()->getGroup() as $group): ?>

                            <?php if($group->getUsers()):?>
                                <div class="list-group-item d-flex bg-light fw-bolder justify-content-between align-items-center">
                                    <span><?= $group->getLabel()?></span>
                                    <span>
                                        <?php if($group->getTutor()): ?>
                                            <a href="#"><?=$group->getTutor()->getLastName()?></a>
                                        <?php endif;?>
                                    </span>
                                </div>
                                <?php foreach ($group->getUsers() as $user):?>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>
                                            <?php if($group->getTutor()): ?>
                                                <?php if($group->getTutor()->getId() == $user->getId()): ?>
                                                    <i class="fa fa-graduation-cap fa-fw me-2"></i>
                                                    <?php else:?>
                                                        <i class="fa fa-user fa-fw me-2"></i>
                                                <?php endif;?>
                                                <?php else:?>
                                                    <i class="fa fa-user fa-fw me-2"></i>
                                            <?php endif;?>
                                            <?= "{$user->getFirstname()} {$user->getLastname()}"?>
                                        </span>
                                    </div>

                                <?php endforeach;?>
                            <?php else:?>
                                <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start">
                                    <span>Noch keine Mitglieder vorhanden.</span>
                                </div>
                            <?php endif;?>

                    <?php endforeach;?>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>

</div>

<?php $this->stop() ?>
