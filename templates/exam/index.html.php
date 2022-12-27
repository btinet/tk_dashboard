<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var array $subjectTypes Fachbereiche
 */

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
