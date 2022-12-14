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
 * @var bool $isNew Leitfrage neu?
 */

use App\Entity\User;
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
                        <form id="claim_form" method="post" action="<?=$response->generateUrlFromRoute('kq_new_transfer')?>" name="claim_form" class="list-group list-group-flush needs-validation" novalidate>
                            <input id="topic" name="topic" readonly type="hidden" value="<?=$exam->getTopic()->getTitle()?>">
                            <input type="hidden" name="csrf_token" value="<?=$session->get('csrf_token')?>">
                            <input type="hidden" name="exam_id" value="<?=$exam->getId()?>">
                            <?php $i = 1;?>
                            <?php foreach($exam->getSchoolSubjects() as $subject): ?>
                                <input class="form-control-plaintext" id="school_subject_<?=$i?>" name="school_subject_<?=$i?>" readonly type="hidden" value="<?=$subject->getLabel()?>">
                                <?php $i++ ?>
                            <?php endforeach; ?>

                            <?php if($isNew):?>
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <h5>Leitfrage verfassen</h5>
                                        <p>Verfasse deine Leitfrage auf Basis deiner ausgewählten Daten.</p>
                                    </div>
                                    <div class="card-body bg-lighter">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-12 col-md-2 d-none">
                                                <label class="" for="key_question">Leitfrage</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea id="key_question" name="key_question" type="text" class="form-control" placeholder="<?=htmlspecialchars($exam->getKeyQuestion())?>" rows="3" required></textarea>
                                                <div class="invalid-feedback">
                                                    Bitte formuliere deine Leitfrage.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php else:?>
                                    <input id="key_question" name="key_question" type="hidden" value="<?=htmlspecialchars($exam->getKeyQuestion())?>">
                            <?php endif;?>

                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5>Betreuende Lehrkraft auswählen</h5>
                                    <p class="mb-0">Die betreuende Lehrkraft begleitet dich bis zur Prüfung. Sinnvollerweise hast du mit ihr bereits im Vorfeld gesprochen.</p>
                                    <small class="text-muted">
                                        Sollte keine Lehrkraft verfügbar sein, wende dich bitte an die <a href="#">Schulleitung</a>.
                                    </small>
                                </div>
                                <div class="card-body bg-lighter">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-12 col-md-2 d-none">
                                            <label class="" for="supervisor">Lehrkraft</label>
                                        </div>
                                        <div class="col-12">
                                            <select id="supervisor" name="supervisor" class="form-select" required>
                                                <option value="">auswählen</option>
                                                    <?php foreach($supervisors as $supervisor): ?>
                                                        <?php if($supervisor instanceof User):?>
                                                            <option value="<?=$supervisor->getId()?>"><?=$supervisor->getLastName()?></option>
                                                        <?php endif;?>
                                                    <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Bitte betreuende Lehrkraft auswählen.
                                            </div>
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