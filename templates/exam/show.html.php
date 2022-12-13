<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var int $current_school_subject_id Id des aktuellen Schulfachs
 * @var object $exam enthält die MySQL-Tabelle "exam"
 * @var Session $session Session-Objekt
 */

use Core\Component\SessionComponent\Session;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.standard.html',
    [
        'current_school_subject_id' => $exam->getSchoolSubjects()[0]->getId()
    ]
);

?>

<?php $this->start('main') ?>
    <div class="row g-3 mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="h6 fw-light text-muted text-uppercase mb-0 ps-3">zugeordnet</div>
                <a class="btn btn-sm btn-light border d-inline-block d-md-none" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Fächer ein-/ausblenden
                </a>
            </div>


            <div class="collapse show" id="collapseExample">
                <div class="list-group list-group-flush rounded-3 border shadow-sm">
                        <?php foreach($exam->getSchoolSubjects() as $subject): ?>
                            <a href="<?=$response->generateUrlFromRoute('exam_list',[$subject->getId()]) ?>" class="list-group-item list-group-item-action lh-sm py-3 d-flex justify-content-between align-items-center">
                                <div class=" d-flex justify-content-between align-items-center">
                                    <span class="badge border bg-light text-primary text-capitalize me-2" style="width: 40px"><?=$subject->getAbbr() ?></span>
                                    <strong><?=$subject->getLabel() ?></strong>
                                </div>
                                <span class="badge text-bg-light text-muted"><?=$subject->countExams()?></span>
                            </a>
                        <?php endforeach; ?>
                    <?php if(!$schoolSubjects): ?>
                        <li class="list-group-item">Keine Prüfungen gefunden.</li>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <div class="col-12">
            <div class="row g-3">
                <div class="col-12">
                    <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Details</div>
                    <?= $this->insert('app/_exam_list.html',['exams'=>[$exam]]) ?>
                </div>
                <div class="col-12">
                    <div class="row g-3">
                        <?php if ($session->getUser()): ?>
                            <?php if ($session->getUser()->hasGroupPermission('create_key_question') and $session->userHasPermission('create_key_question')): ?>

                                <?php if(date('Y') >= ($exam->getYear()+3) and !$exam->getUser()):?>
                                    <div class="col-12 col-md-6">
                                        <a href="<?=$response->generateUrlFromRoute('kq_claim_start',[$exam->getId()])?>" class="btn btn-primary d-block">Thema übernehmen</a>
                                    </div>
                                    <?php else: ?>
                                        <div class="col-12 col-md-6">
                                            <a href="#" class="btn btn-light border d-block disabled">Thema übernehmen</a>
                                        </div>
                                <?php endif; ?>
                                    <div class="col-12 col-md-6">
                                        <a href="<?=$response->generateUrlFromRoute('kq_copy_start',[$exam->getId()])?>" class="btn btn-light d-block">ähnliche Leitfrage erstellen</a>
                                    </div>
                            <?php else: ?>
                                <p class="lead">Du kannst keine Leitfrage erstellen oder übernehmen?</p>
                                <p>Du bist offensichtlich in keinem Kurs der Qualifikationsphase. Wende dich für Unterstützung an deine:n Tutor:in.</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $this->stop() ?>
