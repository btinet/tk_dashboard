<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object|null $meta enthält Meta-Daten der Website
 * @var object $response enthält Response-Daten des Controllers
 */

/**
 * Übergeordnetes Template
 */
$this->layout('base.html',
    [
        'meta'=>$meta,
        'response'=>$response
    ]
);

?>

<?php $this->start('body') ?>

    <header id="header">
        <?php if ($this->section('header')): ?>
            <?=$this->section('header')?>
        <?php else: ?>
            <div class="container">
                <div class="py-3">
                    <span class="small text-muted">Navigation</span>
                </div>
            </div>
        <?php endif ?>
    </header>

    <main id="main" class="container">
        <?php if ($this->section('main')): ?>
            <?=$this->section('main')?>
        <?php else: ?>
            <div class="row">default main content</div>
        <?php endif ?>
    </main>

    <footer id="footer" class="mt-auto bg-light">
        <?php if ($this->section('footer')): ?>
            <?=$this->section('footer')?>
        <?php else: ?>
            <div class="container">
                <div class="py-3">
                    <span class="small text-muted">Wagner's simple MVC-PHP-Framework</span>
                </div>
            </div>
        <?php endif ?>
    </footer>

<?php $this->stop() ?>

