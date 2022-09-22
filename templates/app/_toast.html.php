<?php

/**
 * @var string $type Message Type
 * @var string $message Message Text
 * @var Object $trans Translation object
 */

?>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="position: absolute; z-index: 10000">

        <div id="liveToast" class="toast show text-bg-<?=$type?>" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Information</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <span><?=$trans->getConfig($message)?></span>
            </div>
        </div>

    </div>