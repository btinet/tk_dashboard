<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var int|null $number Glücksnummer
 * @var string $btn href-link
 * @var object|null $meta enthält Meta-Daten der Website
 * @var object $response enthält Response-Daten des Controllers
 * @var object $results enthält die Suchergebnisse
 * @var object $mainMenu enthält die Hauptnavigation"
 * @var Session $session Session-Objekt
 * @var string $queryString Suche
 * @var object $schoolSubjects Schulfächer
 * @var int $current_school_subject_id Id des aktuellen Schulfachs
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
        <div class="col-12 col-md-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="border rounded-3 bg-white p-3 w-100">
                        <p class="text-muted"><?=count($results)?> Ergebnis<?php if(1!==count($results)){echo 'se';}?> für die Suche nach</p>
                        <h2 class="fst-italic"><?=$queryString?></h2>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Suchergebnisse</div>
            <div class="list-group list-group-flush rounded-3 border">
                <?php foreach($results as $exam): ?>
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
                    </a>
                <?php endforeach; ?>
                <?php if(!$results): ?>
                    <li class="list-group-item">Keine Ergebnisse gefunden.</li>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $this->stop() ?>
