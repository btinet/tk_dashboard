<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var Object $trans Translation object
 * @var Session $session Session-Objekt
 * @var array|false $userData Formulardaten des Benutzers
 * @var SchoolSubjectType $objects School Subject Types
 */


use App\Entity\SchoolSubjectType;
use Core\Component\SessionComponent\Session;

?>

<form method="post" id="role_form" class="row g-3 mb-4 needs-validation" action="<?=$response->generateUrlFromRoute('admin_topic_new')?>" novalidate>
    <div class="col-12">
        <div class="form-floating">
            <input type="text" class="form-control" id="title" name="title" value="<?=$userData?$userData['title']:false?>" placeholder="<?=$trans->getConfig('title')?>" required>
            <label for="title"><?=$trans->getConfig('label')?></label>
            <div class="invalid-feedback">
                Bitte gib eine Bezeichnung ein.
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="text" class="form-control" id="description" name="description" value="<?=$userData?$userData['description']:false?>" placeholder="<?=$trans->getConfig('description')?>" required>
            <label for="description"><?=$trans->getConfig('description')?></label>
            <div class="invalid-feedback">
                Bitte gib eine Beschreibung ein.
            </div>
        </div>
    </div>
    <input type="hidden" id="csrf_token" name="csrf_token" value="<?=$session->get('csrf_token')?>">
</form>