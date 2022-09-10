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
 * @var object $exams enthält die MySQL-Tabelle "exam"
 * @var object $mainMenu enthält die Hauptnavigation"
 */

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.standard.html',
    [
        'meta'=>$meta,
        'response'=>$response,
        'mainMenu' => $mainMenu
    ]
);

?>

<?php $this->start('main') ?>
    <div class="row g-3 mb-3">
        <div class="col-12 col-md-4">
            <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Fächer</div>
            <div class="list-group list-group-flush rounded-3 border">
                <?php foreach($schoolSubjects as $subject): ?>
                    <a href="<?=$response->generateUrlFromRoute('school_subject_show',[$subject->getId()]) ?>" class="list-group-item list-group-item-action lh-sm py-3 d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <strong>
                                <span class="badge bg-light text-primary text-capitalize me-1" style="width: 40px"><?=$subject->getAbbr() ?></span>
                                <?=$subject->getLabel() ?>
                            </strong>
                            <small class="text-truncate text-wrap"></small>
                        </div>
                        <div class="d-flex align-items-end flex-column">
                        </div>
                    </a>
                <?php endforeach; ?>
                <?php if(!$schoolSubjects): ?>
                    <li class="list-group-item">Keine Prüfungen gefunden.</li>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Prüfungsthemen</div>
            <div class="list-group list-group-flush rounded-3 border">
                <?php foreach($exams as $exam): ?>
                    <a href="#" class="list-group-item list-group-item-action lh-sm py-3 d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <strong><?=$exam->getTopic()->getTitle() ?></strong>
                            <small class="text-truncate text-wrap"><?=$exam->getTopic()->getDescription() ?></small>

                            <div class="d-flex mt-2 small fw-light justify-content-start align-items-center">
                                <?php foreach($exam->getSchoolSubjects() as $subject): ?>
                                    <span class="badge me-1 text-capitalize <?=$subject->isMainSchoolSubject() ? 'bg-primary' :'bg-secondary' ?>"><?=$subject->getAbbr()?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="d-flex align-items-end flex-column">
                            <span class="small text-nowrap">frei ab</span>
                            <?= $exam->getYear()+3 ?>
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
