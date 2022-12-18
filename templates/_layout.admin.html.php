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
 * @var object $adminMenu Admin Menu
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
    <header id="header" class="py-2 mb-0 border-bottom sticky-top shadow-sm fit">
        <?php if ($this->section('header')): ?>
            <?=$this->section('header')?>
        <?php else: ?>
            <div class="container">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <div class="d-flex justify-content-start align-items-center h-100">


                            <div class="btn-group">
                                <a class="btn btn-ghost-light text-dark d-none d-lg-block" href="<?=$response->generateUrlFromRoute('exam_index')?>">
                                    <i class="fa-solid fa-fw fa-house"></i>
                                </a>
                                <a class="btn btn-ghost-light text-dark d-block me-1 d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    <i class="fa-solid fa-fw fa-navicon"></i>
                                </a>
                                <?php if($session->UserHasPermission('create_key_question')):?>
                                    <a class="btn btn-ghost-light text-dark" href="<?=$response->generateUrlFromRoute('kq_new_start')?>">
                                        <i class="fa-solid fa-fw fa-plus"></i>
                                    </a>
                                <?php endif;?>
                                <?php if(!$session->get('login')): ?>
                                    <a class="btn btn-light" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Anmelden" href="<?=$response->generateUrlFromRoute('authentication_login')?>"><i class="fa fa-fw fa-sign-in"></i></a>
                                <?php else: ?>
                                <div class="btn-group">
                                    <a role="button" href="<?=$response->generateUrlFromRoute('user_profile_index')?>" class="btn btn-ghost-light text-dark"><i class="fa-solid fa-fw fa-user"></i></a>
                                    <button type="button" class="btn btn-ghost-light text-dark dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                    <?php if($session->UserHasPermission('show_profile')): ?>
                                    <li>
                                        <a class="dropdown-item d-flex justify-content-start align-items-center" href="<?=$response->generateUrlFromRoute('user_profile_index')?>">
                                            <i class="fa fa-fw fa-user me-1"></i>
                                            Profil
                                        </a>
                                    </li>
                                            <?php endif; ?>
                                            <?php if($session->UserHasPermission('show_user_exam')): ?>
                                            <li>
                                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="#">
                                                    <i class="fa fa-fw fa-file-text me-1"></i>
                                                    Meine Themen
                                                </a>
                                            </li>

                                            <?php endif; ?>
                                            <?php if($session->UserHasPermission('show_dashboard')): ?>
                                                <li class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="<?=$response->generateUrlFromRoute('admin_index')?>">
                                                    <i class="fa fa-fw fa-dashboard me-1"></i>
                                                    Administration
                                                </a>
                                            </li>

                                            <?php endif;?>
                                        <li class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item d-flex justify-content-start align-items-center" href="<?=$response->generateUrlFromRoute('authentication_logout')?>">
                                                <i class="fa fa-fw fa-sign-out text-danger me-1"></i>
                                                Abmelden
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-9">
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
    <main id="main" class="flex-grow-1 bg-lighter fit">
        <div class="container h-100">
        <?php if ($this->section('main')): ?>
        <div class="row h-100">
            <div class="col-12 col-lg-3 border-end py-4 px-0 d-none d-lg-block bg-side">
                <div class=" sticky-top mb-3" style="top:70px;z-index: 5;">
                    <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Administration</div>
                    <?php $this->insert('app/list_group.html',['objects'=>$adminMenu, 'response'=>$response,]); ?>
                </div>
            </div>
            <div class="col-12 col-lg-9 align-content-stretch py-4">
                <?=$this->section('main')?>
            </div>
        </div>
        <?php else: ?>
            <div class="row">default main content</div>
        <?php endif ?>
        </div>
    </main>
    <footer id="footer" class="mt-auto border-top text-bg-lighter fit">
        <?php if ($this->section('footer')): ?>
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

