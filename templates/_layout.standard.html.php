<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object|null $meta enthält Meta-Daten der Website
 * @var object $response enthält Response-Daten des Controllers
 * @var object $mainMenu Hauptnavigation
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

    <header id="header" class="py-3 mb-3 border-bottom">
        <?php if ($this->section('header')): ?>
            <?=$this->section('header')?>
        <?php else: ?>
            <div class="container-fluid">
                <div class="row g-3">
                    <div class="col-2 col-md-4">
                        <div class="dropdown">
                            <a href="#" class="d-flex text-primary align-items-center justify-content-md-start justify-content-center mb-0 link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-microsoft me-md-2" style="font-size: 1.5em"></i><small class="small text-uppercase text-muted d-none d-md-inline-block">EASE</small>
                            </a>
                            <ul class="dropdown-menu text-small shadow" style="">
                                <?php foreach ($mainMenu as $item): ?>
                                    <li class="">
                                        <a href="<?= $item->getRoute()?>" class="dropdown-item"
                                        <?php foreach($item->getAttrib() as $attrib => $value): ?><?=$attrib?>="<?=implode(' ',$value)?>"<?php endforeach; ?>
                                        >
                                        <?= $item->getLabel() ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-10 col-md-8">
                        <div class="d-flex align-items-center">
                            <form class="w-100" role="search">
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Stichwort..." aria-label="Suche">
                                    <button class="btn btn-primary" type="submit" role="button" id="button-addon2"><i class="bi bi-search"></i> </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </header>

    <main id="main" class="container-fluid pb-3">
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
                    <span class="small text-muted"><?=$meta->get('footer_text')?></span>
                </div>
            </div>
        <?php endif ?>
    </footer>

<?php $this->stop() ?>

