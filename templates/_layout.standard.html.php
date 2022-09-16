<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object|null $meta enthält Meta-Daten der Website
 * @var object $response enthält Response-Daten des Controllers
 * @var object $mainMenu Hauptnavigation
 * @var Session $session Session-Objekt
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var null|int $current_school_subject_id Id des aktuellen Schulfachs
 */

/**
 * Übergeordnetes Template
 */

use Core\Component\SessionComponent\Session;

$this->layout('base.html',
    [
        'meta'=>$meta,
        'response'=>$response,
    ]
);

?>

<?php $this->start('body') ?>
<?php $this->insert('app/_offcanvas.html',[
        'mainMenu'=>$mainMenu,
        'response'=>$response,
        'schoolSubjects' => $schoolSubjects,
        'current_school_subject_id' => $current_school_subject_id
    ]);
?>
    <header id="header" class="py-2 mb-3 border-bottom sticky-top">
        <?php if ($this->section('header')): ?>
            <?=$this->section('header')?>
        <?php else: ?>
            <div class="container-fluid">
                <div class="row g-3">
                    <div class="col-5 col-md-4">
                        <div class="d-flex justify-content-start align-items-center h-100">
                            <a class="btn btn-light link-primary me-1 d-block d-md-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                <i class="fa fa-fw fa-list" style="font-size: 1.2em"></i>
                            </a>

                            <a class="btn btn-light link-primary me-1 d-none d-md-block" href="<?=$response->generateUrlFromRoute('app_index')?>"><i class="fa fa-fw fa-list" style="font-size: 1.2em"></i></a>
                            <?php if(!$session->get('login')): ?>
                                <a class="btn btn-light link-primary ms-auto" href="<?=$response->generateUrlFromRoute('authentication_login')?>"><i class="fa fa-fw fa-sign-in" style="font-size: 1.2em"></i></a>
                            <?php else: ?>
                                <a class="btn btn-light link-danger ms-auto" href="<?=$response->generateUrlFromRoute('authentication_logout')?>"><i class="fa fa-fw fa-sign-out" style="font-size: 1.2em"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="d-flex align-items-center">
                            <form class="w-100" role="search" method="post" action="<?=$response->generateUrlFromRoute('app_search')?>">
                                <div class="input-group">
                                    <input type="search" class="form-control" name="search" placeholder="Stichwort..." aria-label="Suche" required>
                                    <input type="hidden" class="d-none" name="csrf_token" value="<?=$session->get('csrf_token')?>">
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

    <footer id="footer" class="mt-auto text-bg-primary">
        <?php if ($this->section('footer')): ?>
            <?=$this->section('footer')?>
        <?php else: ?>
            <div class="container">
                <div class="py-3 d-flex justify-content-start align-items-center">
                    <img class="" src="<?=$response->generateUrlFromString('/assets/images/tk_logo_24px.png')?>" height="24" width="96" alt="Treptow Kolleg Baum Logo">
                    <span class="small"><?=$meta->get('footer_text')?></span>
                </div>
            </div>
        <?php endif ?>
    </footer>

<?php $this->stop() ?>

