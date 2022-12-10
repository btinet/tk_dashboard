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
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="border rounded-3 bg-white p-3 w-100 shadow-sm">
                        <p class="text-muted"><?=count($results)?> Ergebnis<?php if(1!==count($results)){echo 'se';}?> für die Suche nach</p>
                        <h2 class="fst-italic"><?=$queryString?></h2>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Suchergebnisse</div>
            <?= $this->insert('app/_exam_list.html',['exams'=>$results]) ?>
        </div>
    </div>
<?php $this->stop() ?>
