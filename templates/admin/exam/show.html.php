<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var Object $adminMenu Set of menu objects
 * @var Object $trans Translation object
 * @var Exam $object UserRole object
 * @var RolePermission $permissions RolePermission object
 * @var array|false $userData Formulardaten des Benutzers
 * @var array $table Tabledata for current entity
 * @var Object $adminMenu Set of menu objects
 */


use App\Entity\Exam;
use App\Entity\RolePermission;
use Core\Component\SessionComponent\Session;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.admin.html',
    [
        'current_school_subject_id' => 0,
        'adminMenu' => $adminMenu
    ]
);

?>

<?php $this->start('main') ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Berechtigungen zuordnen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=$this->insert('admin/role/_form_add_permission.html',[
                    'userData'=>$userData,
                    'object' => $object,
                    'permissions' => $permissions,
                ]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light " data-bs-dismiss="modal">Abbrechen</button>
                <button role="button" form="role_form" type="submit" class="btn btn-primary">Speichern</button>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3 my-3">
    <div class="col-12">
        <div class="mb-3 d-flex justify-content-start">
            <a href="<?=$response->generateUrlFromRoute('admin_exam_index',[0])?>"  class="btn btn-primary me-2 d-block d-md-inline-block">Zur Übersicht</a>
        </div>

        <h1><?=$trans->getConfig('Exam')?> anzeigen</h1>
    </div>
    <div class="col-12">



        <div class="">
            <form class="row g-3">
                <div class="col-5">
                    <label for="label" class="form-label"><?=$trans->getConfig('Id')?></label>
                    <input id="label" type="text" readonly disabled class="form-control" value="<?=$object->getId()?>">
                </div>
                <div class="col-7">
                    <label for="label" class="form-label"><?=$trans->getConfig('Student')?></label>
                    <input id="label" type="text" readonly disabled class="form-control" value="<?=$object->getUser()?>">
                </div>
                <div class="col-6">
                    <label for="label" class="form-label"><?=$trans->getConfig('Created')?></label>
                    <input id="label" type="date" readonly disabled class="form-control" value="<?=(new DateTime($object->getCreated()))->format('Y-m-d')?>">
                </div>
                <div class="col-6">
                    <label for="label" class="form-label"><?=$trans->getConfig('Updated')?></label>
                    <input id="label" type="date" readonly disabled class="form-control" value="<?=(new DateTime($object->getUpdated()))->format('Y-m-d')?>">
                </div>
                <div>
                    <label for="topic" class="form-label"><?=$trans->getConfig('Topic')?></label>
                    <input id="topic" type="text" readonly disabled class="form-control" value="<?=$object->getTopic()?>">
                </div>
                <div>
                    <label for="description" class="form-label"><?=$trans->getConfig('KeyQuestion')?></label>
                    <textarea id="description" rows="4" readonly disabled class="form-control"><?=$object->getKeyQuestion()?></textarea>
                </div>
                <?php foreach($object->getSchoolSubjects() as $subject) :?>
                <div class="col-6">
                    <label for="label" class="form-label">
                        <?= $subject->isMainSchoolSubject() ? $trans->getConfig('MainSchoolSubject'):$trans->getConfig('SecondarySchoolSubject')?>
                    </label>
                    <input id="label" type="text" readonly disabled class="form-control" value="<?=$subject->getLabel()?>">
                </div>
                <?php endforeach;?>
                <div>
                    <label for="year" class="form-label"><?=$trans->getConfig('Year')?></label>
                    <input id="year" type="text" readonly disabled class="form-control" value="<?=$object->getYear()?>">
                </div>
            </form>
        </div>
    </div>

    <?php
    $exams = $object->getRepository()->findBy(Exam::class,['keyQuestion' => $object->getKeyQuestion()]);
    ?>

    <div class="col-12 col-md-3">
        <div class="h6 fw-light text-muted mb-2 ps-3">Weitere Verknüpfungen</div>
        <div class="card">
            <?php if(count((array)$exams)>1):?>
                <div class="list-group list-group-flush">
                    <?php foreach($exams as $exam):?>
                        <?php if($exam->getId() !== $object->getId()):?>
                            <a class="list-group-item list-group-item-action" href="<?=$response->generateUrlFromRoute('admin_exam_show',[$exam->getId()])?>">
                                <?=$exam->getYear()?>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
            <?php else:?>
            <div class="card-body">
                <p class="card-text">Keine weiteren Verknüpfungen gefunden.</p>
            </div>
            <?php endif;?>
        </div>
    </div>

</div>
<?php $this->stop() ?>
