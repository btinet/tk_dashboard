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
 * @var null|Exam[]|Exam $test
 */


use App\Entity\Exam;
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

<?php
$groups = [];
$groupCount = [];
foreach ($session->getUser()->getGroup() as $group) {
    $groups[] = $group->getLabel();
    $groupCount[] = count($group->getUsers());
}

$subjects = [];
$examCounts = [];
$subjectColors = [];


foreach ($schoolSubjects as $subject) {
    $subjects[] = $subject->getAbbr();
    $examCounts[] = $subject->countExams();
    $subjectColors[] = $subject->getColor();
}
$examCountMax = max($examCounts);

?>

<?php $this->start('main') ?>


<div class="row g-3 mb-3">

    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body border-1">
                <h2 class="h5">Persönliches Konto</h2>
                <div class="d-flex justify-content-center align-items-start flex-column">
                    <span class="small">Name</span>
                    <?= $session->getUser()->getFirstname(true) ?> <?= $session->getUser()->getLastName(true) ?>
                    <span class="small mt-2">E-Mail-Adresse</span>
                    <span class="text-truncate"><?= $session->getUser()->getEmail(true) ?></span>
                    <span class="small mt-2">Mitglied seit</span>
                    <?= $session->getUser()->getCreated()->format('d.m.Y') ?>
                </div>
            </div>
            <?php if ($session->UserHasPermission('has_supervisor')): ?>
                <div class="card-body bg-lighter">
                    <h2 class="h5">Betreuung</h2>
                    <p>Konfigurieren Sie hier Ihren Betreuungsstatus. Bedenken Sie, dass die Schulleitung die maximale
                        Betreuungskapazität überschreiben kann.</p>
                    <form method="post" action="<?= $response->generateUrlFromRoute('user_profile_save_settings') ?>"
                          class="row row-cols-lg-auto g-3 align-items-center form-inline">
                        <div class="col-12">
                            <label class="visually-hidden" for="inlineFormInputGroupUsername">Anzahl
                                Kollegiat:innen</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fa-solid fa-users"></i></div>
                                <input type="number" name="pupil_amount" min="1" max="10"
                                       value="<?= $attribs['supervise']['pupil_amount'] ?: 1 ?>" class="form-control"
                                       id="inlineFormInputGroupUsername" placeholder="Anzahl Kollegiat:innen">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="enable"
                                       type="checkbox" <?= $attribs['supervise']['supervise_enable'] ? 'checked' : '' ?>
                                       role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Betreuung
                                    aktivieren?</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary">Speichern</button>
                        </div>
                        <input type="hidden" id="csrf_token" name="csrf_token"
                               value="<?= $session->get('csrf_token') ?>">
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<div class="row g-3 mb-3">

    <?php if ($session->UserHasPermission('has_supervisor')): ?>
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Mir zugewiesen</h2>
                    <p>Folgende Anträge warten auf Ihre Überprüfung.</p>
                </div>
                <div class="list-group list-group-flush">
                    <div href="#" class="list-group-item align-items-start bg-light bg-gradient fw-bolder">
                        <div class="row g-2">
                            <div class="col-12 col-md-3 text-truncate d-none d-md-block">
                                Kollegiat:in
                            </div>
                            <div class="col-12 col-md-7 text-truncate">
                                Leitfrage
                            </div>
                            <div class="col-12 col-md-2 text-start text-md-end d-none d-md-block">
                                Datum
                            </div>
                        </div>
                    </div>
                    <?php if ($foreignExams): ?>
                        <?php foreach ($foreignExams as $exam): ?>
                            <a href="#" class="list-group-item list-group-item-action align-items-center">
                                <div class="row g-2">
                                    <div class="col-12 col-md-3 text-truncate">
                                        <span class="d-flex align-items-baseline">
                                            <i class="fa fa-user me-2"></i>
                                            <?=$exam->getUser()->getUsername(true)?>
                                        </span>
                                    </div>

                                    <div class="col-12 col-md-7 text-truncate">
                                        <span class="d-flex align-items-baseline">
                                            <i class="fa fa-file me-2"></i>
                                            <?= $exam->getKeyQuestion() ?>
                                        </span>
                                    </div>
                                    <div class="col-12 col-md-2 text-start text-md-end">
                                        <div class="text-muted"><?= $exam->getCreated()->format('d.m.Y') ?></div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start">
                            <span>Ihr Postfach ist äußerst ordentlich.</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($session->UserHasPermission('show_user_exam')): ?>
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5 mb-0">Meine Prüfungsthemen</h2>
                </div>
                <div class="list-group list-group-flush">
                    <?php if ($userExam): ?>
                        <?php foreach ($userExam as $exam): ?>
                            <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start">
                                <div>
                                    <div class="my-2">
                                        <span class="badge text-bg-primary"><?= $exam->getMainSchoolSubject()->getLabel() ?></span>
                                        <span class="badge text-bg-light"><?= $exam->getSecondarySchoolSubject()->getLabel() ?></span>
                                    </div>
                                    <a href="<?=$response->generateUrlFromRoute('user_profile_show_exam',[$exam->getId()])?>" class="fw-bolder"><?= $exam->getKeyQuestion() ?></a>
                                    <div class="small my-2 text-muted">am <?= $exam->getCreated()->format('d.m.Y') ?> erstellt</div>
                                    <span class="text-bg-info badge"><?= $trans->getConfig($exam->getStatus()) ?></span>
                                    <span class="text-bg-light border badge"><?= $exam->getStatus()->getInfo() ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start">
                            <span>Noch kein Prüfungsthema beantragt.</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($session->UserHasPermission('show_my_group')): ?>
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5 mb-0">Meine Kurse</h2>
                </div>
                <div class="list-group list-group-flush">
                    <?php foreach ($session->getUser()->getGroup() as $group): ?>

                        <?php if ($group->getUsers()): ?>
                            <div class="list-group-item d-flex bg-light bg-gradient text-bg-secondary fw-bolder justify-content-between align-items-center">
                                <span><?= $group->getLabel() ?></span>
                                <span class="d-flex align-items-baseline">
                                    <?php if ($tutor = $group->getTutor()): ?>
                                        <i class="fa fa-graduation-cap fa-fw me-1"></i>
                                        <a href="#" class="link-dark"><?= $group->getTutor()->getUsername(true) ?></a>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <?php foreach ($group->getUsers() as $user): ?>
                                <a href="#"
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>
                                            <?php if ($group->getTutor()): ?>
                                                <?php if ($group->getTutor()->getId() == $user->getId()): ?>
                                                    <i class="fa fa-graduation-cap fa-fw me-2"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-user fa-fw me-2"></i>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <i class="fa fa-user fa-fw me-2"></i>
                                            <?php endif; ?>
                                            <?=$user->getUsername(true)?>
                                        </span>
                                </a>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start">
                                <span>Noch keine Mitglieder vorhanden.</span>
                            </div>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>



</div>

<?php $this->stop() ?>
