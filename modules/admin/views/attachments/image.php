<?php
use yii\helpers\Html;
use app\modules\admin\models\Files;?>

<?if($image):?>
    <div class="attachments">
        <div class="attach-wrap image-type_<?=$type;?>">
            <div class="attach-action attach-delete">
                <span class="fa fa-remove"></span>
            </div>
            <div class="attach">
                <?=Html::img(Files::getRelativePath($type, $image)) ?>
            </div>
        </div>
    </div>
<?endif;?>