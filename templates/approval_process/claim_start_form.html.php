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
 * @var array $supervisors List of supervisors
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
                    <?= $this->insert('app/_exam_list_blink.html',['exams'=>[$exam]]) ?>
                </div>

                <div class="col-12">
                    <div class="d-flex justify-content-start flex-row align-items-center card bg-white shadow-sm border-warning border border-2 rounded-3 text-bg-light text-dark mb-3 p-3">
                        <i class="fa fa-warning me-2 text-warning"></i>
                        Bitte prüfe alle Formulardaten, bevor du fortfährst. Mit Absenden des Formulars beginnt der Genehmigungsprozess!
                    </div>
                        <form id="claim_form" method="post" action="<?=$response->generateUrlFromRoute('kq_claim_transfer')?>" name="claim_form" class="list-group list-group-flush">
                            <input id="topic" name="topic" readonly type="hidden" value="<?=$exam->getTopic()->getTitle()?>">
                            <input id="key_question" name="key_question" type="hidden" value="<?=$exam->getKeyQuestion()?>" readonly>
                            <input type="hidden" name="csrf_token" value="<?=$session->get('csrf_token')?>">
                            <input type="hidden" name="exam_id" value="<?=$exam->getId()?>">
                            <?php $i = 1;?>
                            <?php foreach($exam->getSchoolSubjects() as $subject): ?>
                                <input class="form-control-plaintext" id="school_subject_<?=$i?>" name="school_subject_<?=$i?>" readonly type="hidden" value="<?=$subject->getLabel()?>">
                                <?php $i++ ?>
                            <?php endforeach; ?>
                            <div class="card shadow-sm">
                                <div class="card-header bg-gradient">
                                    <h6 class="mb-0">Betreuende Lehrkraft auswählen</h6>
                                </div>
                                <div class="card-body">
                                    <p>Die betreuende Lehrkraft begleitet dich bis zur Prüfung.</p>
                                    <div class="row g-3 row-cols-md-auto align-items-center">
                                        <div class="col-12 d-none d-md-block">
                                            <label class="" for="supervisor">Lehrkraft</label>
                                        </div>
                                        <div class="col-12">
                                            <select id="supervisor" name="supervisor" class="form-select" required>
                                                <option selected>auswählen</option>
                                                <?php foreach($supervisors as $supervisor): ?>
                                                    <option value="<?=$supervisor->getId()?>"><?=$supervisor->getLastName()?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                </div>

                <div class="col-12 col-md-6">
                    <button type="submit" form="claim_form" class="btn btn-primary w-100 d-block">Leitfrage einreichen</button>
                </div>
                <div class="col-12 col-md-6">
                    <a href="<?=$response->generateUrlFromRoute('exam_show',[$exam->getId()])?>" class="btn btn-light d-block">abbrechen</a>
                </div>

            </div>
        </div>
    </div>
<?php $this->stop() ?>