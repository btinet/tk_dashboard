<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var Object $trans Translation object
 * @var Session $session Session-Objekt
 * @var UserRole $object UserRole object
 * @var UserRoleRepository $repository Repository object
 * @var RolePermission $permissions RolePermission object
 * @var array|false $userData Formulardaten des Benutzers
 */


use App\Entity\RolePermission;
use App\Entity\UserRole;
use App\Repository\UserRoleRepository;
use Core\Component\SessionComponent\Session;

?>

<form method="post" id="role_form" class="row g-3 mb-4 needs-validation" action="<?=$response->generateUrlFromRoute('admin_role_new')?>" novalidate>
    <?php if (array_filter((array)$permissions)): ?>
        <?php foreach ($permissions as $permission): ?>
            <?php if (!$repository->findOnePermission($object->getId(),$permission->getId())):?>
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="<?=$permission->getId()?>" type="checkbox" role="switch" id="switch_<?=$permission->getId()?>">
                        <label class="form-check-label" for="switch_<?=$permission->getId()?>"><?=$permission->getLabel()?></label>
                        <span class=""></span>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach;?>
    <?php endif;?>
    <input type="hidden" id="csrf_token" name="csrf_token" value="<?=$session->get('csrf_token')?>">
</form>