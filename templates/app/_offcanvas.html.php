<?php

/**
* @var object|null $meta enthält Meta-Daten der Website
* @var object $response enthält Response-Daten des Controllers
* @var object $mainMenu Hauptnavigation
* @var object $schoolSubjects Schulfächer
* @var int $current_school_subject_id Id des aktuellen Schulfachs
*/

?>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title h6 text-uppercase fw-light" id="offcanvasExampleLabel">Hauptmenü</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <div class="list-group list-group-flush border mb-3" style="">
            <?php foreach ($mainMenu as $item): ?>
                    <a href="<?= $item->getRoute()?>" class="list-group-item list-group-item-action py-3"
                    <?php foreach($item->getAttrib() as $attrib => $value): ?><?=$attrib?>="<?=implode(' ',$value)?>"<?php endforeach; ?>
                    >
                    <?= $item->getLabel() ?>
                    </a>
            <?php endforeach; ?>
        </div>
        <h5 class="h6 text-uppercase fw-light px-3" id="offcanvasExampleLabel">Fächer</h5>
        <div class="list-group list-group-flush border mb-3">
            <?php if($schoolSubjects): ?>
                <?php foreach($schoolSubjects as $subject): ?>
                    <?php $isActive = ($current_school_subject_id == $subject->getId()) ? 'active' : '';?>
                    <a href="<?=$response->generateUrlFromRoute('exam_list',[$subject->getId()]) ?>" class="list-group-item <?=$isActive?> list-group-item-action lh-sm py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-light text-primary text-capitalize me-1" style="width: 40px"><?=$subject->getAbbr() ?></span>
                            <strong><?=$subject->getLabel() ?></strong>
                        </div>
                        <span class="badge text-bg-light text-muted"><?=$subject->countExams()?></span>
                    </a>
                <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item">Keine Fächer gefunden.</li>
            <?php endif; ?>
        </div>
    </div>
</div>

<!--
                        <div class="dropdown">
                            <a href="#" class="d-flex text-primary align-items-center justify-content-md-start justify-content-center mb-0 link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bars me-md-2" style="font-size: 1.5em"></i><small class="small text-uppercase text-muted d-none d-md-inline-block">EASE</small>
                            </a>



                        </div>
                        </-->