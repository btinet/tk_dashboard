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

<?php
$groups = [];
$groupCount = [];
foreach ($session->getUser()->getGroup() as $group) {
    $groups[]=$group->getLabel();
    $groupCount[]=count($group->getUsers());
}

$subjects = [];
$examCount = [];
$subjectColors = [];


foreach ($schoolSubjects as $subject) {
    $subjects[]=$subject->getAbbr();
    $examCount[]=$subject->countExams();
    $subjectColors[]=$subject->getColor();
}
$examCountMax = max($examCount);
$examSum= array_sum($examCount);

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

</div>
<div class="row g-3 mb-3">

    <div class="col-12 col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-5 d-none d-md-block">
        <div class="card shadow-sm">
            <div class="card-body">
                <div>
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 col-md-2">
        <div class="card text-bg-info text-white align-self-stretch h-100 shadow-sm">
            <div class="card-body">
                <h1>Leitfragen gesamt</h1>
                <p class="display-4"><i class="fa fa-hashtag"></i><?=$examSum?></p>
            </div>
        </div>
    </div>
</div>
<div class="row g-3">

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
                                        <span class="text-bg-info badge"><?=$trans->getConfig($exam->getStatus())?></span>
                                        <span class="text-bg-light border badge"><?=$exam->getStatus()->getInfo()?></span>
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
                                <div class="list-group-item d-flex bg-light bg-gradient text-bg-secondary fw-bolder justify-content-between align-items-center">
                                    <span><?= $group->getLabel()?></span>
                                    <span class="d-flex align-items-baseline">
                                        <?php if($group->getTutor()): ?>
                                            <i class="fa fa-graduation-cap fa-fw me-1"></i>
                                            <a href="#" class="link-dark"><?=$group->getTutor()->getLastName()?></a>
                                        <?php endif;?>
                                    </span>
                                </div>
                                <?php foreach ($group->getUsers() as $user):?>
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
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
                                    </a>

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


<script>
    const ctx = document.getElementById('myChart');

    const labels = <?=json_encode($groups)?>;
    const data = {
        labels: labels,
        datasets: [{
            label: 'Mitglieder',
            data:<?=json_encode($groupCount)?>,
            borderWidth: 0,
        }]
    };

    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            hover: {
                mode: 'label'
            },
            scales: {
                y: {
                    suggestedMin: 0,
                    suggestedMax: 10,
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function(value, index, ticks) {
                            return value;
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Kursstärken'
                },
                legend: {
                    display: false
                }
            }
        }
    });

    const ctx2 = document.getElementById('myChart2');

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: <?=json_encode($subjects)?>,
            datasets: [{
                label: 'Anzahl',
                data: <?=json_encode($examCount)?>,
                borderWidth: 1,
                backgroundColor: <?=json_encode($subjectColors)?>
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    suggestedMin: 0,
                    suggestedMax: <?=$examCountMax?>,
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function(value, index, ticks) {
                            return value;
                        },
                        stepSize: 1
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Anzahl der Leitfragen je Fach'
                },
                legend: {
                    display: false
                }
            }
        }
    });

</script>

<?php $this->stop() ?>
