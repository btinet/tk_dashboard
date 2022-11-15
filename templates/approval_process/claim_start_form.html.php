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
        'current_school_subject_id' => $current_school_subject_id
    ]
);

?>

<?php $this->start('main') ?>
    <div class="row g-3 mb-3">
        <div class="col-12 col-md-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="h6 fw-light text-muted text-uppercase mb-0 ps-3">zugeordnet</div>
                <a class="btn btn-sm btn-light border d-inline-block d-md-none" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Fächer ein-/ausblenden
                </a>
            </div>

            <div class="collapse show" id="collapseExample">
                <div class="list-group list-group-flush rounded-3 border">
                    <?php foreach($exam->getSchoolSubjects() as $subject): ?>
                        <a href="<?=$response->generateUrlFromRoute('exam_list',[$subject->getId()]) ?>" class="list-group-item list-group-item-action lh-sm py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-light text-primary text-capitalize me-1" style="width: 40px"><?=$subject->getAbbr() ?></span>
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
        <div class="col-12 col-md-8">
            <div class="row g-3">
                <div class="col-12">
                    <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Details</div>
                    <div class="list-group list-group-flush rounded-3 border">
                        <div class="list-group-item lh-sm py-3 d-flex justify-content-between align-items-start">
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
                                <p class="card-text small"><?=$exam->getKeyQuestion()?></p>

                            </div>
                            <div class="d-flex align-items-end flex-column">
                                <span class="small text-nowrap">frei ab</span>
                                <?= $exam->getYear()+3 ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="d-flex justify-content-start flex-row align-items-center card bg-lighter border-warning border border-2 rounded-3 text-bg-light text-dark mb-3 p-3">
                        <i class="fa fa-warning me-2 text-warning"></i>
                        Bitte prüfe alle Formulardaten, bevor du fortfährst. Mit Absenden des Formulars beginnt der Genehmigungsprozess!
                    </div>
                    <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Daten zur Leitfrage</div>
                    <div class="card">
                        <form id="claim_form" method="get" name="claim_form" class="list-group list-group-flush">
                            <div class="list-group-item">
                                <label for="topic" class="form-label fw-bolder">Themengruppe</label>
                                <input class="form-control-plaintext" id="topic" name="topic" readonly type="text" value="<?=$exam->getTopic()->getTitle()?>">
                            </div>
                            <div class="list-group-item">
                                <label for="key_question" class="form-label fw-bolder">Leitfrage</label>
                                <textarea rows="4" class="form-control-plaintext" id="key_question" name="key_question" readonly><?=$exam->getKeyQuestion()?></textarea>
                            </div>
                            <?php $i = 1;?>
                            <?php foreach($exam->getSchoolSubjects() as $subject): ?>
                                <div class="list-group-item">
                                    <label for="school_subject_<?=$i?>" class="form-label fw-bolder">
                                        <?=$subject->isMainSchoolSubject() ? 'Referenzfach' :'Begleitfach' ?>
                                    </label>
                                    <input class="form-control-plaintext" id="school_subject_<?=$i?>" name="school_subject_<?=$i?>" readonly type="text" value="<?=$subject->getId()?>">
                                </div>
                            <?php $i++ ?>
                            <?php endforeach; ?>
                            <input type="hidden" name="csrf_token" value="<?=$session->get('csrf_token')?>">
                        </form>
                    </div>
                </div>

                <div class="col-12">
                    <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Persönliche Angaben</div>
                    <div class="card">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <label for="username" class="form-label fw-bolder">Name</label>
                                <input form="claim_form" class="form-control-plaintext" id="username" name="username" readonly type="text" value="<?=$session->getUser()->getFirstname().' '.$session->getUser()->getLastName()?>">
                            </div>
                            <div class="list-group-item">
                                <label for="group" class="form-label fw-bolder">Kurs</label>
                                <input form="claim_form" class="form-control-plaintext" id="group" name="group" readonly type="text" value="<?=$session->getUser()->getCurrentGroup()->getLabel()?>">
                            </div>
                            <div class="list-group-item">
                                <label for="tutor" class="form-label fw-bolder">Tutor:in</label>
                                <input form="claim_form" class="form-control-plaintext" id="tutor" name="tutor" readonly type="text" value="<?=$session->getUser()->getCurrentGroup()->getTutor()->getLastName()?>">
                            </div>
                        </div>
                    </div>
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