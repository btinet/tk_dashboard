<?php

/**
 * @var Object $objects Set of menu objects
 * @var Config $trans TranslationConfig-Objekt
 */

use Core\Component\ConfigComponent\Config;

?>
<div class="list-group list-group-flush border-top border-bottom">
    <?php if($objects): ?>
        <?php foreach ($objects as $object) : ?>
            <a
                href="<?= $object->getRoute()?>"
                class="bg-gradient
                <?php foreach($object->getAttrib() as $class => $value) {
                    echo implode(' ', $value);
                }
                ?>
                "
                <?php foreach($object->getAttrib() as $attrib => $value) {
                    echo $attrib. '="' . implode(' ', $value) . '"';
                };
                ?>
            >
                <?=$trans->getConfig($object->getLabel())?>
            </a>
        <?php endforeach; ?>
        <?php else: ?>

    <?php endif; ?>
</div>
