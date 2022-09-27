<?php

/**
 *  Table Template
 * @var Response $response
 * @var array $fields
 * @var array $data
 * @var object $trans
 */

use Core\Component\HttpComponent\Response;

?>
<div class="table-responsive rounded-3 bg-white border mb-3">
    <table class="table table-hover table-striped mb-0 sortable-theme-bootstrap" data-sortable>
        <caption class="px-2 small"><?= $caption ?? 'Tabelle' ?></caption>
        <thead>
        <tr>
            <td></td>
            <?php foreach ($fields as $column): ?>
                <?php if($column['is_header']):?>
                    <th><?=$trans->getConfig($column['label']) ?? $column['label'] ?></th>
                    <?php else: ?>
                        <td><?=$trans->getConfig($column['label']) ?? $column['label']?></td>
                <?php endif; ?>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $item): ?>
                <tr>
                    <td class="text-center">
                        <div class="form-check form-switch">
                            <input form="delete_entry" class="form-check-input" name="mark_row[]" value="<?=$item->getId()?>" type="checkbox" role="switch" id="switch_<?=$item->getId()?>">
                            <label class="form-check-label d-none" for="switch_<?=$item->getId()?>"></label>
                        </div>
                    </td>
                    <?php foreach ($fields as $column): ?>
                    <?php $getter = "get{$column['label']}"; ?>
                        <td>
                            <?php if(isset($column['route_name'])):?>
                                <a href="<?=$response->generateUrlFromRoute($column['route_name'],[$item->getId()])?>"><?=$item->$getter()?></a>
                                <?php else: ?>
                                <?=$item->$getter()?>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


