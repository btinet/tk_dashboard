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
 * @var GenericRepository $repository
 */

use App\Entity\SchoolSubject;
use App\Entity\User;
use App\Repository\GenericRepository;
use Core\Component\SessionComponent\Session;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.profile.html',
    [
        'current_school_subject_id' => 0,
        'menu' => null
    ]
);

?>

<?php $this->start('main') ?>
    <div class="row g-3 mb-3">
        <div class="col-12">
            <div class="row g-3">
                <div class="col-12">
                    <div class="d-flex justify-content-start flex-row align-items-center card bg-white shadow-sm border-warning border border-2 rounded-3 text-bg-light text-dark mb-3 p-3">
                        <i class="fa fa-warning me-2 text-warning"></i>
                        Bitte prüfe alle Formulardaten, bevor du fortfährst. Mit Absenden des Formulars beginnt der Genehmigungsprozess!
                    </div>
                        <form id="claim_form" method="post" action="<?=$response->generateUrlFromRoute('kq_new_transfer')?>" name="claim_form" class="list-group list-group-flush needs-validation" novalidate>
                            <input id="topic" name="topic" readonly type="hidden" value="1">
                            <input type="hidden" name="csrf_token" value="<?=$session->get('csrf_token')?>">
                            <input type="hidden" name="exam_id" value="">
                            <input class="form-control-plaintext" id="school_subject_1" name="school_subject_1" readonly type="hidden" value="">

                            <div class="card shadow-sm mb-3">
                                <div class="card-body">
                                    <h5>Referenz- und Begleitfach auswählen</h5>
                                    <p>Wähle die thematisch passenden Fächer aus. Referenz- und Begleitfach dürfen nicht identisch sein.</p>
                                </div>
                                <div class="card-body bg-lighter">
                                    <div class="row g-3 align-items-start">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="reference">Referenzfach</label>
                                            <select id="reference" name="school_subject_1" class="form-select" required>
                                                <option value="">auswählen</option>
                                                <?php foreach($repository->setEntity(SchoolSubject::class)->findAll(['label' => 'asc']) as $subject): ?>
                                                    <?php if($subject instanceof SchoolSubject):?>
                                                        <option value="<?=$subject->getId()?>"><?=$subject->getLabel()?></option>
                                                    <?php endif;?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Bitte Referenzfach wählen.
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="secondary">Begleitfach</label>
                                            <select id="secondary" name="school_subject_2" class="form-select" required>
                                                <option value="">auswählen</option>
                                                <?php foreach($repository->setEntity(SchoolSubject::class)->findAll(['label' => 'asc']) as $subject): ?>
                                                    <?php if($subject instanceof SchoolSubject):?>
                                                        <option value="<?=$subject->getId()?>"><?=$subject->getLabel()?></option>
                                                    <?php endif;?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Bitte Begleitfach wählen.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


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
                                                <textarea id="key_question" name="key_question" type="text" class="form-control" placeholder="" rows="3" required></textarea>
                                                <div class="invalid-feedback">
                                                    Bitte formuliere deine Leitfrage.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php else:?>
                                    <input id="key_question" name="key_question" type="hidden" value="">
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
                                                            <option value="<?=$supervisor->getId()?>"><?=$supervisor->getLastName(true)?></option>
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
                    <a href="<?=$response->generateUrlFromRoute('user_profile_index')?>" class="btn btn-light border-1 border-secondary d-block">abbrechen</a>
                </div>

            </div>
        </div>
    </div>
<?php $this->stop() ?>