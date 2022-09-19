<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var Object $adminMenu Set of menu objects
 * @var Object $trans Translation object
 * @var Object $objects Translation object
 * @var UserRole $userRoles Objekt mit allen Benutzerrollen
 * @var array|false $userData Formulardaten des Benutzers
 */


use App\Entity\UserRole;
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gruppe anlegen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=$this->insert('admin/group/_form.html',['userData'=>$userData,'userRoles'=>$userRoles]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light link-primary" data-bs-dismiss="modal">Abbrechen</button>
                <button role="button" form="role_form" type="submit" class="btn btn-primary">Speichern</button>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <div></div>
    <div class="col-12 col-md-3">
        <div class="d-none d-md-block">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="h6 fw-light text-muted text-uppercase mb-0 ps-3">Menü</div>
            </div>

            <div class="collapse show" id="collapseExample">
                <?php $this->insert('app/list_group.html',['objects'=>$adminMenu, 'response'=>$response,]);
                ?>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-9">
        <div class="h6 fw-light text-muted text-uppercase mb-2 ps-3"><?=$trans->getConfig('roles')?></div>

        <div class="mb-3 d-flex justify-content-start">
            <button  class="btn btn-light link-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Gruppe anlegen</button>
            <?=$this->insert('/app/_batch_delete_form.html')?>
        </div>

        <div class="table-responsive bg-white rounded-3 border mb-3">
            <table class="table table-hover  table-striped mb-0">
                <caption class="px-2 small">Gruppenübersicht</caption>
                <thead>
                <tr>
                    <th><?=$trans->getConfig('label')?></th>
                    <th><?=$trans->getConfig('role')?></th>
                    <th><?=$trans->getConfig('description')?></th>
                    <th><?=$trans->getConfig('created')?></th>
                    <th><?=$trans->getConfig('updated')?></th>
                </tr>
                </thead>
                <tbody>
                <?php if (array_filter((array)$objects)): ?>
                    <?php foreach ($objects as $object): ?>
                        <tr>
                            <th><?=$object->getLabel()?></th>
                            <th><?=$object->getRoleId()?></th>
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
                                <?php for ($k = 1; $k <= 2;$k++): ?>
                                    <?php $randInt = rand(6,12); ?>
                                    <td class="placeholder-wave"><span class="placeholder col-<?=$randInt?> bg-light"></span></td>
                                <?php endfor; ?>
                                <td class="placeholder-wave"><span class="placeholder col-12 bg-light"></span></td>
                                <td class="placeholder-wave"><span class="placeholder col-12 bg-light"></span></td>
                            </tr>
                    <?php endfor;?>
                    <tr>
                        <td colspan="6" class="text-center"><a href="<?=$response->generateUrlFromRoute('admin_group_new')?>" class="btn btn-light link-primary">Neue Gruppe erstellen</a></td>
                    </tr>
                    <?php for ($i = 1; $i <= 3;$i++): ?>
                        <?php $randInt = rand(6,12); ?>
                        <tr>
                            <th class="placeholder-wave"><span class="placeholder col-6 bg-light"></span></th>
                            <?php for ($k = 1; $k <= 2;$k++): ?>
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
            <button  class="btn btn-light link-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Gruppe anlegen</button>
            <a href="#" class="btn btn-light link-primary">Rolle zuordnen</a>
            <a href="#" class="btn btn-light link-primary">Benutzer zuordnen</a>
        </div>

    </div>
</div>
<?php $this->stop() ?>
