<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object|null $meta enthält Meta-Daten der Website
 * @var object $response enthält Response-Daten des Controllers
 * @var object $km Kaffeemaschinen-Instanz
 * @var object $h Mensch-Instanz
 * @var object $mainMenu enthält die Hauptnavigation"
 * @var array $message Log-Buch
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
<div class="row">
    <h2>Kaffeemaschine</h2>
</div>

<div class="row">
    <div class="col-4 fw-bold">Methode</div>
    <div class="col-6 fw-bold">Wert</div>
</div>
<div class="row">
    <div class="col-4">$km->isOn()</div>
    <div class="col-6"><?=$km->isOn()? 'ja' : 'nein' ?></div>
</div>
<div class="row">
    <div class="col-4">$km->isReady()</div>
    <div class="col-6"><?=$km->isReady()? 'ja' : 'nein' ?></div>
</div>
<div class="row">
    <div class="col-4">$km->getAmountOfWater()</div>
    <div class="col-6"><?=$km->getAmountOfWater()?>%</div>
</div>
<div class="row">
    <div class="col-4">$km->getAmountOfCoffee()</div>
    <div class="col-6"><?=$km->getAmountOfCoffee()?>%</div>
</div>
<hr>

<div class="row">
    <h2>Mensch</h2>
</div>
<div class="row">
    <div class="col-4 fw-bold">Methode</div>
    <div class="col-6 fw-bold">Wert</div>
</div>
<div class="row">
    <div class="col-4">$h->isTired()</div>
    <div class="col-6"><?=$h->isTired()? 'ja' : 'nein' ?></div>
</div>
<div class="row">
    <div class="col-4">$h->getCoffeeAmount()</div>
    <div class="col-6"><?=$h->getCoffeeAmount()?>%</div>
</div>
<hr>
<h3 class="mt-5">Logbuch</h3>
<div class="row">
    <div class="col">
        <code>
            <?php foreach($message as $line => $content): ?>
               <div><?= $content ?></div>
            <?php endforeach; ?>
        </code>
    </div>
</div>
<?php $this->stop() ?>
