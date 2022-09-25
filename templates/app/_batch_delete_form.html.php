<?php

/**
 * @var Session $session
 */

use Core\Component\SessionComponent\Session;

?>

<div class="dropdown">
    <a class="btn btn-light  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        markierte Elemente
    </a>
    <ul class="dropdown-menu">
        <li>
            <form id="delete_entry" method="post" onsubmit="return confirm('Möchten Sie die gewählten Elemente wirklich löschen?');"></form>
            <input form="delete_entry" type="hidden" name="csrf_token" value="<?=$session->get('csrf_token')?>">
            <button form="delete_entry" id="list_delete" type="submit" class="dropdown-item">
                <i class="fa fa-fw fa-trash me-1 text-danger"></i>
                Löschen
            </button>
        </li>
    </ul>
</div>