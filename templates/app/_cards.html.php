<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var array $items Fachbereiche
 * @var Response $response
 */

use Core\Component\HttpComponent\Response;

?>

<div class="row g-3 row-cols-1">
    <?php foreach ($items as $item):?>
        <?php if($item->getSchoolSubjects()):?>
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-header bg-light bg-gradient fw-bolder"><?=$item->getLabel()?></div>
                <div class="list-group list-group-flush">
                    <?php foreach ($item->getSchoolSubjects() as $subject):?>
                        <a href="<?=$response->generateUrlFromRoute('exam_list',[$subject->getId()]) ?>" class="list-group-item list-group-item-action" style="border-left-style: solid;border-left-width: 8px!important;border-left-color: <?=$subject->getColor()?>"><?=$subject->getLabel()?></a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <?php endif;?>
    <?php endforeach;?>
</div>
