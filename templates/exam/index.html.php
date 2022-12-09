<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var object $exams enthält die MySQL-Tabelle "exam"
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
            <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Prüfungsthemen</div>

            <div class="list-group list-group-flush rounded-3 border shadow-sm">
                <?php foreach($exams as $exam): ?>
                    <a href="<?=$response->generateUrlFromRoute('exam_show',[$exam->getId()])?>" class="list-group-item list-group-item-action lh-sm py-3 d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <strong><?=$exam->getTopic()->getTitle() ?></strong>
                            <small class="text-truncate text-wrap"><?=$exam->getTopic()->getDescription() ?></small>

                            <div class="d-flex my-2 small fw-light justify-content-start align-items-center">
                                <?php foreach($exam->getSchoolSubjects() as $subject): ?>
                                    <span class="badge me-1 text-capitalize <?=$subject->isMainSchoolSubject() ? 'bg-primary' :'bg-secondary' ?>"><?=$subject->getAbbr()?></span>
                                <?php endforeach; ?>
                                <?php if(date('Y') < ($exam->getYear()+3)):?>
                                    <span class="me-1 badge badge-pill text-bg-danger small">gesperrt</span>
                                <?php else: ?>
                                    <?php if($exam->getUser()):?>
                                        <span class="badge badge-pill text-bg-info small">belegt</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <p class="card-text"><?=$exam->getKeyQuestion()?></p>
                        </div>
                        <div class="d-flex align-items-end flex-column">
                            <span class="small badge text-bg-light fw-light bg-gradient border text-nowrap">
                                frei ab
                                <?= $exam->getYear()+3 ?>
                            </span>
                        </div>
                    </a>
                <?php endforeach; ?>
                <?php if(!$exams): ?>
                    <li class="list-group-item">Keine Prüfungen gefunden.</li>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $this->stop() ?>
