<?php
use yii\helpers\Html;;?>

<div class="attachments">
    <div class="attach-wrap">
        <div class="attach-action attach-delete">
            <span class="fa fa-remove"></span>
        </div>
        <div class="attach">
            <?=Html::img("/load/{$dir}/{$file}") ?>
        </div>
    </div>
</div>

