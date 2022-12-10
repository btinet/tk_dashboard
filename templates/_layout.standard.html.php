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
                    <div class="col-5 col-md-3">
                        <div class="d-flex justify-content-start align-items-center h-100">
                            <a class="btn btn-light  me-1 d-block d-md-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                <i class="fa fa-fw fa-navicon" style="font-size: 1.2em"></i>
                            </a>

                            <a class="btn btn-light  me-1 d-none d-md-block" href="<?=$response->generateUrlFromRoute('app_index')?>">
                                <i class="fa fa-fw fa-home" style="font-size: 1.2em"></i>
                            </a>
                            <?php if(!$session->get('login')): ?>
                                <a class="btn btn-light" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Anmelden" href="<?=$response->generateUrlFromRoute('authentication_login')?>"><i class="fa fa-fw fa-sign-in" style="font-size: 1.2em"></i></a>
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
                    <div class="col-7 col-md-9">
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
    <main id="main" class="flex-grow-1">
        <div class="container-fluid">
        <?php if ($this->section('main')): ?>
        <div class="row h-100">
            <div class="col-12 col-md-3 border-end py-3 px-0">
                <?php if($user = $session->getUser()): ?>
                    <div class=" sticky-top mb-3" style="top:60px;z-index: 5;">
                    <div class="col-12">
                        <div class="d-none d-md-block">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="h6 fw-light text-muted text-uppercase mb-0 ps-3">Fächer</div>
                                <a class="btn btn-sm btn-light border d-inline-block d-md-none" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Fächer ein-/ausblenden
                                </a>
                            </div>
                            <div class="collapse show" id="collapseExample">
                                <div class="list-group list-group-flush border-top border-bottom">
                                    <?php foreach($schoolSubjects as $subject): ?>
                                        <?php $isActive = ($current_school_subject_id == $subject->getId()) ? 'active bg-gradient' : '';?>
                                        <a href="<?=$response->generateUrlFromRoute('exam_list',[$subject->getId()]) ?>" class="list-group-item <?=$isActive?> list-group-item-action lh-sm py-3 d-flex justify-content-between align-items-center">
                                            <div class=" d-flex justify-content-between align-items-center">
                                                <span class="badge border bg-light text-primary text-capitalize me-2" style="width: 40px"><?=$subject->getAbbr() ?></span>
                                                <strong><?=$subject->getLabel() ?></strong>
                                            </div>
                                            <span class="badge text-bg-light text-muted"><?=$subject->countExams()?></span>
                                        </a>
                                    <?php endforeach; ?>
                                    <?php if(!$schoolSubjects): ?>
                                        <li class="list-group-item">Keine Fächer gefunden.</li>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
            <div class="col-12 col-md-9 bg-lighter align-content-stretch py-3">
                <?=$this->section('main')?>
            </div>
        </div>
        <?php else: ?>
            <div class="row">default main content</div>
        <?php endif ?>
        </div>
    </main>
<footer id="footer" class="mt-auto border-top text-bg-lighter">
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

