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
    <table class="table table-hover table-striped mb-0 sortable">
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
            <?php if (!empty($data)):?>
                <?php foreach ($data as $item): ?>
                    <tr>
                        <td class="text-center">
                            <div class="form-check form-switch">
                                <input form="delete_entry" class="form-check-input" name="mark_row[]" value="<?=$item->getId()?>" type="checkbox" role="switch" id="switch_<?=$item->getId()?>">
                                <label class="form-check-label d-none" for="switch_<?=$item->getId()?>"></label>
                            </div>
                        </td>
                        <?php foreach ($fields as $column): ?>
                            <?php
                            $columnValue = null;
                            $getter = "get{$column['label']}";
                            switch ($column['format'])
                            {
                                case 'int':
                                    $columnValue = intval($item->$getter());
                                    break;
                                case 'year':
                                    $columnValue = date("Y", mktime(0, 0, 0, 1, 1, $item->$getter()));
                                    break;
                                default:
                                    $columnValue = $item->$getter();
                                    break;
                            }
                            ?>
                            <?php if(isset($column['route_identifier'])):?>
                                <?php $routeIdentifier = "get{$column['route_identifier']}"; ?>
                            <?php endif; ?>
                            <td>
                                <?php if(isset($column['route_name'])):?>
                                    <a href="<?=$response->generateUrlFromRoute($column['route_name'],[$item->$routeIdentifier()])?>">
                                        <?=$columnValue?>
                                    </a>
                                    <?php else: ?>
                                    <?=$columnValue?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <?php for($a = 1; $a <= 5;$a++):?>
                    <tr>
                        <?php if ($a !== 3):?>
                            <?php for($i = 0; $i <= count($fields);$i++):?>
                                <td class="placeholder-wave"><span class="placeholder col-6 bg-light"></span></td>
                            <?php endfor; ?>
                        <?php else: ?>
                            <td colspan="<?=count($fields)+1?>" class="text-center">Noch keine Einträge vorhanden!</td>
                        <?php endif; ?>
                    </tr>
                <?php endfor; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>


