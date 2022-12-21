<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var Object $adminMenu Set of menu objects
 * @var Object $trans Translation object
 * @var Object $userExam user exam object
 * @var Object $foreignExams foreign user exam object
 * @var int $examCount Number of distinct Exams listet
 * @var Session $session Session-Objekt
 * @var array|false $userData Formulardaten des Benutzers
 * @var array $table Tabledata for current entitx
 * @var int $rows row count of current entity
 * @var int $currentPage current offset
 * @var array $attribs user_role attributes and data
 * @var ProfileMenu $menu
 * @var UserHasExam $exam
 */


use App\Entity\UserHasExam;
use App\Menu\ProfileMenu;
use Core\Component\SessionComponent\Session;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.profile.html',
    [
        'current_school_subject_id' => 0,
        'menu' =>   $menu
    ]
);

?>

<?php $this->start('main') ?>


<div class="row g-3 mb-3">

    <?php if ($session->UserHasPermission('show_user_exam')): ?>
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5 mb-0">Meine Prüfung</h2>
                </div>
                <div class="list-group list-group-flush">
                    <?php if ($exam instanceof UserHasExam): ?>
                            <?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $exam->getCreated()) ?>
                            <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start">
                                <div>
                                    <div class="my-2">
                                        <span class="badge text-bg-primary"><?= $exam->getMainSchoolSubject()->getLabel() ?></span>
                                        <span class="badge text-bg-light"><?= $exam->getSecondarySchoolSubject()->getLabel() ?></span>
                                    </div>
                                    <a href="#" class="fw-bolder"><?= $exam->getKeyQuestion() ?></a>
                                    <div class="small my-2 text-muted">am <?= $date->format('d.m.Y') ?> erstellt</div>
                                    <span class="text-bg-info badge"><?= $trans->getConfig($exam->getStatus()) ?></span>
                                    <span class="text-bg-light border badge"><?= $exam->getStatus()->getInfo() ?></span>
                                </div>
                            </div>
                    <?php else: ?>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start">
                            <span>Noch kein Prüfungsthema beantragt.</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php $this->stop() ?>
