<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var Array $exams enthält Response-Daten des Controllers
 * @var Response $response
 */

use Core\Component\HttpComponent\Response;

?>

<div class="list-group list-group-flush rounded-3 border shadow-sm">
    <?php foreach($exams as $exam): ?>
        <?php $examState = ' key-question '; ?>
        <?php if(date('Y') < ($exam->getYear()+3)):?>
            <?php $examState .= 'key-question-restricted'; ?>
        <?php else: ?>
            <?php if($exam->getUser()):?>
                <?php $examState .= 'key-question-blocked'; ?>
            <?php endif; ?>
        <?php endif; ?>
        <a href="<?=$response->generateUrlFromRoute('exam_show',[$exam->getId()])?>" class="list-group-item <?=$examState?> list-group-item-action lh-sm py-3 d-flex justify-content-between align-items-start">
            <div class="d-flex flex-column justify-content-between align-items-start">
                <strong><?=$exam->getTopic()->getTitle() ?></strong>
                <small class="text-truncate text-wrap"><?=$exam->getTopic()->getDescription() ?></small>

                <div class="d-flex my-2 small fw-light justify-content-start align-items-center">
                    <?php foreach($exam->getSchoolSubjects() as $subject): ?>
                        <span class="badge me-1 text-capitalize <?=$subject->isMainSchoolSubject() ? 'bg-primary' :'bg-secondary' ?>"><?=$subject->getAbbr()?></span>
                    <?php endforeach; ?>
                    <?php if(date('Y') < ($exam->getYear()+3)):?>
                        <span class="me-1 badge badge-pill text-bg-danger small">gesperrt</span>
                    <?php else: ?>
                        <?php if($exam->getUser()):?>
                            <span class="badge badge-pill text-bg-info small">belegt</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <p class="card-text"><?=$exam->getKeyQuestion()?></p>

            </div>
            <div class="d-flex align-items-end flex-column">
                                    <span class="small badge text-bg-light fw-light bg-gradient border text-nowrap">
                                frei ab
                                <?= $exam->getYear()+3 ?>
                            </span>
            </div>
        </a>
    <?php endforeach; ?>
    <?php if(!$exams): ?>
        <li class="list-group-item">Keine Prüfungen gefunden.</li>
    <?php endif; ?>
</div>