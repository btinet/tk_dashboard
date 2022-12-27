<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $exams enthält die MySQL-Tabelle "exam"
 * @var array $subjectTypes Fachbereiche
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
            <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Fachbereiche</div>
            <?= $this->insert('app/_cards.html',['items'=>$subjectTypes]) ?>
        </div>
    </div>
<?php $this->stop() ?>
