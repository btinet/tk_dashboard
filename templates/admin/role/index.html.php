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
 * @var Session $session Session-Objekt
 * @var array|false $userData Formulardaten des Benutzers
 */


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
                <h5 class="modal-title" id="exampleModalLabel">Rolle anlegen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=$this->insert('admin/role/_form.html',['userData'=>$userData]) ?>
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
            <button  class="btn btn-light link-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Rolle anlegen</button>
            <?=$this->insert('/app/_batch_delete_form.html')?>
        </div>


        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-start">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>

        <div class="table-responsive rounded-3 bg-white border mb-3">
            <table class="table table-hover table-striped mb-0 sortable-theme-bootstrap" data-sortable>
                <caption class="px-2 small">Rollenübersicht</caption>
                <thead>
                <tr>
                    <td></td>
                    <th><?=$trans->getConfig('label')?></th>
                    <th><?=$trans->getConfig('description')?></th>
                    <th><?=$trans->getConfig('created')?></th>
                    <th><?=$trans->getConfig('updated')?></th>
                </tr>
                </thead>
                <tbody>
                <?php if (array_filter((array)$objects)): ?>
                    <?php foreach ($objects as $object): ?>
                        <tr>
                            <td class="text-center">
                                <div class="form-check form-switch">
                                    <input form="delete_entry" class="form-check-input" name="mark_row[]" value="<?=$object->getId()?>" type="checkbox" role="switch" id="switch_<?=$object->getId()?>">
                                    <label class="form-check-label d-none" for="switch_<?=$object->getId()?>"></label>
                                </div>
                            </td>
                            <td><a href="<?=$response->generateUrlFromRoute('admin_role_show',[$object->getId()])?>"><?=$object->getLabel()?></a></td>
                            <td class="text-nowrap"><?=$object->getDescription()?:''?></td>
                            <td><?=$response->formatDate($object->getCreated())?></td>
                            <td><?=$response->formatDate($object->getUpdated())?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php for ($i = 1; $i <= 3;$i++): ?>
                        <?php $randInt = rand(6,12); ?>
                            <tr>
                                <td class="placeholder-wave"><span class="placeholder col-6 bg-light"></span></td>
                                <td class="placeholder-wave"><span class="placeholder col-6 bg-light"></span></td>
                                <?php for ($k = 1; $k <= 2;$k++): ?>
                                    <?php $randInt = rand(6,12); ?>
                                    <td class="placeholder-wave"><span class="placeholder col-<?=$randInt?> bg-light"></span></td>
                                <?php endfor; ?>
                                <td class="placeholder-wave"><span class="placeholder col-12 bg-light"></span></td>
                                <td class="placeholder-wave"><span class="placeholder col-12 bg-light"></span></td>
                            </tr>
                    <?php endfor;?>
                    <tr>
                        <td colspan="5" class="text-center"><a href="<?=$response->generateUrlFromRoute('admin_role_new')?>" class="btn btn-light link-primary">Neue Rolle erstellen</a></td>
                    </tr>
                    <?php for ($i = 1; $i <= 3;$i++): ?>
                        <?php $randInt = rand(6,12); ?>
                        <tr>
                            <td class="placeholder-wave"><span class="placeholder col-6 bg-light"></span></td>
                            <td class="placeholder-wave"><span class="placeholder col-6 bg-light"></span></td>
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

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-start">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>

        <div class="mb-3 d-flex justify-content-start">
            <button  class="btn btn-light link-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Rolle anlegen</button>
            <?=$this->insert('/app/_batch_delete_form.html')?>
        </div>

    </div>
</div>
<?php $this->stop() ?>
