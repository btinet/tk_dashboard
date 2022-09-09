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
<ul class="list-group list-group-flush">
<?php foreach($students as $student): ?>
    <li class="list-group-item"><?=$student?></li>
<?php endforeach; ?>
    <?php if(!$students): ?>
        <li class="list-group-item">Keine Studenten gefunden.</li>
    <?php endif; ?>
</ul>

<div id="contento">
</div>



<?php $this->stop() ?>
