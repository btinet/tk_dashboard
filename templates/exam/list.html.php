<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var int $current_school_subject_id Id des aktuellen Schulfachs
 * @var object $examsByMainSchoolSubject enthält die MySQL-Tabelle "exam"
 * @var object $examsBySecondarySchoolSubject enthält die MySQL-Tabelle "exam"
 * @var object $currentSchoolSubject enthält aktuelles Schulfach
 */

use Core\Component\SessionComponent\Session;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.standard.html',
    [
        'current_school_subject_id' => $current_school_subject_id
    ]
);

?>

<?php $this->start('main') ?>
    <div class="row g-3 mb-3">

        <div class="col-12">
            <div class="d-block d-md-none">
                <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Aktuelles Fach</div>
                <div class="border rounded-3 bg-white lh-sm p-3 d-flex justify-content-between align-items-center shadow-sm">
                    <div>
                        <span class="badge bg-light text-primary text-capitalize me-1" style="width: 40px"><?=$currentSchoolSubject->getAbbr() ?></span>
                        <strong><?=$currentSchoolSubject->getLabel();?></strong>
                    </div>
                    <span class="badge text-bg-light text-muted"><?=$currentSchoolSubject->countExams()?></span>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row g-3">
                <div class="col-12">
                    <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Referenzfach Prüfungsthemen</div>
                    <?= $this->insert('app/_exam_list.html',['exams'=>$examsByMainSchoolSubject]) ?>
                </div>

                <div class="col-12">
                    <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Begleitfach Prüfungsthemen</div>
                    <?= $this->insert('app/_exam_list.html',['exams'=>$examsBySecondarySchoolSubject]) ?>
                </div>
            </div>
        </div>
    </div>
<?php $this->stop() ?>
