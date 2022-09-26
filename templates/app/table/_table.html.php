<?php

/**
 *  Table Template
 * @var Response $response
 */

use Core\Component\HttpComponent\Response;

?>

<table>
    <thead>
    <tr>
        <?php foreach ($fields as $column): ?>
        <td><?=$column?></td>
        <?php endforeach; ?>
    </tr>
    </thead>
</table>


