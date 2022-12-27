<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object|null $meta enthält Meta-Daten der Website
 */

$this->layout('base.html');

?>

<?php $this->start('body') ?>

    <?php if ($this->section('header')): ?>
        <?=$this->section('header')?>
    <?php endif ?>

    <main id="main" class="flex-grow-1">
        <div class="container-fluid">
        <?php if ($this->section('main')): ?>
        <div class="row">
            <div class="col-12 py-3">
                <?=$this->section('main')?>
            </div>
        </div>
        <?php else: ?>
            <div class="row">default main content</div>
        <?php endif ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto border-top text-bg-lighter">
        <?php if ($this->section('footer')):?>
            <?=$this->section('footer')?>
        <?php else: ?>
            <div class="container">
                <div class="py-3 d-flex justify-content-start align-items-center">
                    <a class="small me-2" target="_blank" href="https://github.com/btinet/tk_dashboard"><i class="fa fa-github me-1"></i>Github</a><?=$meta->get('footer_text')?>
                </div>
            </div>
        <?php endif ?>
    </footer>

<?php $this->stop() ?>
