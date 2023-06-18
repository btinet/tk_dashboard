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
 * @var TableType $table Tabledata for current entitx
 * @var int $rows row count of current entity
 * @var int $currentPage current offset
 * @var array $attribs user_role attributes and data
 * @var ProfileMenu $menu
 * @var UserHasExam $exam
 */


use App\Entity\ExamHasExamStatus;
use App\Entity\UserHasExam;
use App\Menu\ProfileMenu;
use App\Type\TableType;
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

    <?php if ($session->UserHasPermission('update_exam_status')): ?>
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body text-bg-light bg-gradient">
                    <div class="d-flex align-items-center">
                        <span class="badge shadow-sm text-bg-warning me-2"><i class="fa fa-fw fa-info"></i></span>
                        <?= $trans->getConfig($exam->getStatus()) ?>
                    </div>
                </div>
                <div class="list-group list-group-flush">
                    <?php if ($exam instanceof UserHasExam): ?>
                            <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start">
                                <div class="">
                                    <div class="my-2">
                                        <span class="badge text-bg-primary"><?= $exam->getMainSchoolSubject()->getLabel() ?></span>
                                        <span class="badge text-bg-light"><?= $exam->getSecondarySchoolSubject()->getLabel() ?></span>
                                    </div>
                                    <p class="lead fw-bolder mb-1"><?= $exam->getKeyQuestion() ?></p>
                                    <p>Betreuende Lehrkraft: <?=$exam->getSupervisor()->getFullName()?></p>
                                    <div class="">
                                        <?php if('clearance' == $exam->getStatus()):?>
                                        <form method="post" action="<?=$response->generateUrlFromRoute('update_workflow')?>" name="update" class="row g-3 mb-4 needs-validation" novalidate>
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="info" name="info" placeholder="<?=$trans->getConfig('info')?>" required>
                                                    <label for="info"><?=$trans->getConfig('info')?></label>
                                                    <div class="invalid-feedback">
                                                        Bitte gib eine Bemerkung ein.
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="exam_status" name="exam_status" value="revise">
                                            <input type="hidden" id="exam_id" name="exam_id" value="<?=$exam->getId()?>">
                                            <input type="hidden" id="csrf_token" name="csrf_token" value="<?=$session->get('csrf_token')?>">
                                            <div class="col-12">
                                                <button type="submit" name="submit" class="btn btn-light border-1 border-secondary">Überarbeitung anfordern</button>
                                            </div>
                                        </form>

                                            <a href="#" class="btn btn-success">An Fachbereichsleitung weiterleiten</a>
                                            <?php else: ?>
                                            <a href="#" class="btn btn-primary disabled">überarbeiten</a>
                                        <?php endif ?>
                                    </div>
                                    <div class="small my-2 text-muted">am <?= $exam->getCreated()->format('d.m.Y') ?> erstellt</div>
                                </div>
                            </div>
                    <?php else: ?>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start">
                            <span>Noch kein Prüfungsthema beantragt.</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <caption class="px-2 small">Genehmigungsverlauf</caption>
                        <thead>
                        <tr>
                            <th>Bemerkung</th>
                            <th>Status</th>
                            <th>Ersteller</th>
                            <th class="text-end">erstellt</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($exam->getAllExamStatus() as $item): ?>
                            <?php if($item instanceof ExamHasExamStatus):?>
                            <tr>
                                <td class="text-nowrap"><a href="#">Ansehen</a></td>
                                <td class="text-nowrap"><?=$trans->getConfig($item->getExamStatus())?></td>
                                <td class="text-nowrap"><?=$item->getSupervisor()->getUsername(true)?></td>
                                <td class="text-nowrap text-end"><?=$item->getCreated()->format('d.m.Y')?></td>
                            </tr>
                            <?php endif;?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php $this->stop() ?>
