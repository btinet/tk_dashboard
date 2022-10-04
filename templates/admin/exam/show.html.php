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
 */


use App\Entity\RolePermission;
use App\Entity\Exam;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.standard.html',
    [
        'current_school_subject_id' => 0
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

<div class="row g-3 mb-3">
    <div></div>
    <div class="col-12 col-md-3">

        <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3">Details von leitfrage <?=$object->getId()?></div>

        <div class="mb-3 d-flex justify-content-start">
            <a href="<?=$response->generateUrlFromRoute('admin_exam_index',[0])?>"  class="btn btn-primary me-2 w-100 d-block">Zur Übersicht</a>
        </div>

    </div>

    <div class="col-12 col-md-6">

        <h1><?=$trans->getConfig('Exam')?></h1>

        <div class="">
            <form class="row row-cols-1 g-3">
                <div>
                    <label for="label" class="form-label"><?=$trans->getConfig('Id')?></label>
                    <input id="label" type="text" readonly disabled class="form-control" value="<?=$object->getId()?>">
                </div>
                <div>
                    <label for="description" class="form-label"><?=$trans->getConfig('KeyQuestion')?></label>
                    <textarea id="description" readonly disabled class="form-control"><?=$object->getKeyQuestion()?></textarea>
                </div>
                <div>
                    <label for="topic" class="form-label"><?=$trans->getConfig('Topic')?></label>
                    <input id="topic" type="text" readonly disabled class="form-control" value="<?=$object->getTopic()?>">
                </div>
                <div>
                    <label for="year" class="form-label"><?=$trans->getConfig('Topic')?></label>
                    <input id="year" type="text" readonly disabled class="form-control" value="<?=$object->getYear()?>">
                </div>
            </form>
        </div>

    </div>
</div>
<?php $this->stop() ?>
