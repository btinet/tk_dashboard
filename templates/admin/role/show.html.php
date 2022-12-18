<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var Object $adminMenu Set of menu objects
 * @var Object $trans Translation object
 * @var UserRole $object UserRole object
 * @var RolePermission $permissions RolePermission object
 * @var array|false $userData Formulardaten des Benutzers
 * @var array $table Tabledata for current entity
 * @var Object $adminMenu Set of menu objects
 */


use App\Entity\RolePermission;
use App\Entity\UserRole;
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

<div class="row g-3 mb-3">

    <div class="col-12">
        <h1>Rolleneigenschaften</h1>

        <form class="row row-cols-1 g-3">
            <div>
                <label for="label" class="form-label"><?=$trans->getConfig('label')?></label>
                <input id="label" type="text" readonly disabled class="form-control" value="<?=$object->getLabel()?>">
            </div>
            <div>
                <label for="description" class="form-label"><?=$trans->getConfig('description')?></label>
                <textarea id="description" readonly disabled class="form-control"><?=$object->getDescription()?></textarea>
            </div>
        </form>
    </div>

    <div class="col-12">
        <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3"><?=$trans->getConfig('permissions')?></div>

        <div class="mb-3 d-flex justify-content-start">
            <button  class="btn btn-light  me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Zuordnen</button>
            <?=$this->insert('/app/_batch_delete_form.html')?>
        </div>

        <?= $table ?>

        <div class="mb-3 d-flex justify-content-start">
            <button  class="btn btn-light  me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Zuordnen</button>
            <?=$this->insert('/app/_batch_delete_form.html')?>
        </div>

    </div>
</div>
<?php $this->stop() ?>
