<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var Object $adminMenu Set of menu objects
 * @var Object $trans Translation object
 * @var RolePermission $object RolePermission object
 * @var array|false $userData Formulardaten des Benutzers
 */


use App\Entity\RolePermission;
use Core\Component\SessionComponent\Session;

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


<div class="row g-3 mb-3">
    <div></div>
    <div class="col-12 col-md-3">

    </div>

    <div class="col-12 col-md-9">
        <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3"><?=$trans->getConfig('roles')?></div>

        <div class="mb-3 d-flex justify-content-start">
            <button  class="btn btn-light  me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Berechtigung anlegen</button>
            <a href="#" class="btn btn-light ">Gruppe zuordnen</a>
        </div>

        <div class="table-responsive rounded-3 bg-white border mb-3">
            <table class="table table-hover table-striped  rounded-3 mb-0 sortable-theme-bootstrap" data-sortable>
                <caption class="px-2 small">Übersicht der Berechtigungen</caption>
                <thead>
                <tr>
                    <th><?=$trans->getConfig('label')?></th>
                    <th><?=$trans->getConfig('description')?></th>
                    <th><?=$trans->getConfig('created')?></th>
                    <th><?=$trans->getConfig('updated')?></th>
                </tr>
                </thead>
                <tbody>
                <?php if (array_filter((array)$object)): ?>
                    <?php foreach ($object as $object): ?>
                        <tr>
                            <th><?=$object->getLabel()?></th>
                            <td class="text-nowrap"><?=$object->getDescription()?:''?></td>
                            <td><?=$response->formatDate($object->getCreated())?></td>
                            <td><?=$response->formatDate($object->getUpdated())?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php for ($i = 1; $i <= 3;$i++): ?>
                        <?php $randInt = rand(6,12); ?>
                            <tr>
                                <th class="placeholder-wave"><span class="placeholder col-6 bg-light"></span></th>
                                <?php for ($k = 1; $k <= 1;$k++): ?>
                                    <?php $randInt = rand(6,12); ?>
                                    <td class="placeholder-wave"><span class="placeholder col-<?=$randInt?> bg-light"></span></td>
                                <?php endfor; ?>
                                <td class="placeholder-wave"><span class="placeholder col-12 bg-light"></span></td>
                                <td class="placeholder-wave"><span class="placeholder col-12 bg-light"></span></td>
                            </tr>
                    <?php endfor;?>
                    <tr>
                        <td colspan="5" class="text-center"><button  class="btn btn-light  me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Neue Berechtigung erstellen</button></td>
                    </tr>
                    <?php for ($i = 1; $i <= 3;$i++): ?>
                        <?php $randInt = rand(6,12); ?>
                        <tr>
                            <th class="placeholder-wave"><span class="placeholder col-6 bg-light"></span></th>
                            <?php for ($k = 1; $k <= 1;$k++): ?>
                                <?php $randInt = rand(6,12); ?>
                                <td class="placeholder-wave"><span class="placeholder col-<?=$randInt?> bg-light"></span></td>
                            <?php endfor; ?>
                            <td class="placeholder-wave"><span class="placeholder col-12 bg-light"></span></td>
                            <td class="placeholder-wave"><span class="placeholder col-12 bg-light"></span></td>
                        </tr>
                    <?php endfor;?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mb-3 d-flex justify-content-start">
            <button  class="btn btn-light  me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Berechtigung anlegen</button>
            <a href="#" class="btn btn-light ">Gruppe zuordnen</a>
        </div>

    </div>
</div>
<?php $this->stop() ?>
