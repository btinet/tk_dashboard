<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var Object $adminMenu Set of menu objects
 * @var Session $session
 * @var int $examCount Number of distinct Exams listet
 * @var array $groupEntity Alle Gruppen
 */


use Core\Component\SessionComponent\Session;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.admin.html',
    [
        'current_school_subject_id' => 0,
        'adminMenu' => $adminMenu
    ]
);

?>

<?php
$groups = [];
$groupCount = [];
foreach ($groupEntity as $group) {
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
$groupCountMax = max($groupCount);

?>

<?php $this->start('main') ?>
<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Administration</div>
        <div class="rounded-3 bg-white border shadow-sm p-3">
            <h1>Dashboard</h1>
            <p>
                Das ist die Administrationsübersicht. Hier werden Kennungen, Rollen, Themen und vieles mehr verwaltet.
            </p>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <div>
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12">
        <div class="card text-bg-info text-white align-self-stretch h-100 shadow-sm">
            <div class="card-body">
                <h1>Leitfragen gesamt</h1>
                <p class="display-4"><i class="fa fa-hashtag"></i><?= $examCount ?></p>
            </div>
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
            data: <?=json_encode($groupCount)?>,
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
                    suggestedMax: <?=$groupCountMax?>,
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function (value, index, ticks) {
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
                data: <?=json_encode($examCounts)?>,
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
                        callback: function (value, index, ticks) {
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
