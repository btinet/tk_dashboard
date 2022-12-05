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

    <header id="header" class="py-2 mb-0 border-bottom sticky-top shadow-sm">
        <?php if ($this->section('header')): ?>
            <?=$this->section('header')?>
        <?php else: ?>
            <div class="container-fluid">
                <div class="row g-3">
                    <div class="col-5 col-md-4">
                        <div class="d-flex justify-content-start align-items-center h-100">
                            <a class="btn btn-light  me-1 d-block d-md-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                <i class="fa fa-fw fa-navicon" style="font-size: 1.2em"></i>
                            </a>

                            <a class="btn btn-light  me-1 d-none d-md-block" href="<?=$response->generateUrlFromRoute('app_index')?>">
                                <i class="fa fa-fw fa-home" style="font-size: 1.2em"></i>
                            </a>
                            <?php if(!$session->get('login')): ?>
                                <a class="btn btn-light " data-bs-toggle="tooltip" data-bs-title="Anmelden" href="<?=$response->generateUrlFromRoute('authentication_login')?>"><i class="fa fa-fw fa-sign-in" style="font-size: 1.2em"></i></a>
                            <?php else: ?>
                                <div class="dropdown">
                                    <button class="btn btn-light  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-fw fa-user" style="font-size: 1.2em"></i>
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
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="<?=$response->generateUrlFromRoute('admin_index')?>">
                                                    <i class="fa fa-fw fa-dashboard me-1"></i>
                                                    Administration
                                                </a>
                                            </li>
                                        <?php endif;?>
                                        <li><hr class="dropdown-divider"></li>
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
        <div class="row mb-3 g-3 row-cols-1">
            <div class="d-flex flex-wrap justify-content-start align-items-center">
                <?php if($user = $session->getUser()): ?>
                    <div class="btn-group btn-group-sm me-2">
                        <a href="#" class="btn btn-primary btn-sm mb-2 mb-md-0">
                            <i class="fa fa-user-o me-2"></i>
                            <?=substr($user->getFirstName(),0,1)?>. <?=$user->getLastName()?>
                        </a>
                        <?php foreach ($user->getRoles() as $role):?>
                            <a href="#<?=$role->getId()?>" class="btn btn-light btn-sm mb-2 mb-md-0">
                                <?=$role->getLabel()?>
                            </a>
                        <?php endforeach;?>
                    </div>
                    <div class="btn-group btn-group-sm">
                            <span class="btn btn-primary mb-2 mb-md-0">
                                <i class="fa fa-graduation-cap me-1"></i>
                                Kurse
                            </span>
                        <?php foreach ($user->getGroup() as $group): ?>
                            <a href="#" class="btn btn-light btn-sm mb-2 mb-md-0">
                                <?=$group->getLabel()?>
                            </a>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </main>

    <footer id="footer" class="mt-auto text-bg-lighter">
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

