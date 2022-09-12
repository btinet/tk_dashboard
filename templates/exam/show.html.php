<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var int|null $number Glücksnummer
 * @var string $btn href-link
 * @var object|null $meta enthält Meta-Daten der Website
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var int $current_school_subject_id Id des aktuellen Schulfachs
 * @var object $exam enthält die MySQL-Tabelle "exam"
 * @var object $mainMenu enthält die Hauptnavigation"
 * @var Session $session Session-Objekt
 */

use Core\Component\SessionComponent\Session;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.standard.html',
    [
        'meta'=>$meta,
        'response'=>$response,
        'mainMenu' => $mainMenu,
        'session' => $session,
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
                                    <?php endif; ?>
                                    <?php if($exam->getUser()):?>
                                        <span class="badge badge-pill text-bg-info small">belegt</span>
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
                    <?php if(date('Y') >= ($exam->getYear()+3) and !$exam->getUser()):?>
                        <a href="#" class="btn btn-primary d-block d-md-inline-block">Thema übernehmen</a>
                    <?php else: ?>
                        <a href="#" class="btn btn-light border d-block d-md-inline-block disabled">Thema übernehmen</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $this->stop() ?>
