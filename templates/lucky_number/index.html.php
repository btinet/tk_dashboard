<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var int|null $number Glücksnummer
 * @var string $btn href-link
 * @var object|null $meta enthält Meta-Daten der Website
 * @var object $response enthält Response-Daten des Controllers
 * @var object $students enthält die MySQL-Tabelle "students"
 * @var object $exams enthält die MySQL-Tabelle "exam"
 * @var object $mainMenu enthält die Hauptnavigation"
 */

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.standard.html',
    [
        'meta'=>$meta,
        'response'=>$response
    ]
);

?>

<?php $this->start('header') ?>
<div class="container">
    <div class="py-3">
        <ul class="nav nav-tabs">
            <?php foreach ($mainMenu as $item): ?>
                <li class="nav-item">
                    <a href="<?= $item->getRoute()?>"
                       <?php foreach($item->getAttrib() as $attrib => $value): ?><?=$attrib?>="<?=implode(' ',$value)?>"<?php endforeach; ?>
                    >
                        <?= $item->getLabel() ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php $this->stop() ?>


<?php $this->start('main') ?>
    <h1>Lucky Number</h1>
    <?php if($number): ?>
        <p class="lead">Deine Glücksnummer lautet: <?=$number?></p>
    <?php endif ?>
    <a href="<?=$btn?>" class="btn btn-outline-dark">Würfeln</a>

<hr>
<ul class="list-group list-group-flush mb-3">
<?php foreach($students as $student): ?>
    <li class="list-group-item"><?=$student?> (erstellt: <?=$student->getCreated()?>)</li>
<?php endforeach; ?>
    <?php if(!$students): ?>
        <li class="list-group-item">Keine Studenten gefunden.</li>
    <?php endif; ?>
</ul>

<div class="card">
    <div class="card-header">
        Prüfungen
    </div>
    <ul class="list-group list-group-flush">
        <?php foreach($exams as $exam): ?>
            <li class="list-group-item">
                <?php foreach($exam as $key => $value): ?>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold"><?=$key?></span>
                    <span class=""><?=$value?></span>
                </div>

                <?php endforeach; ?>
            </li>
        <?php endforeach; ?>
        <?php if(!$exams): ?>
            <li class="list-group-item">Keine Prüfungen gefunden.</li>
        <?php endif; ?>
    </ul>
</div>

<div id="contento">
</div>



<?php $this->stop() ?>
