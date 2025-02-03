<?php
use yii\helpers\Html;?>

<?if($files->files):
    foreach ($files->files as $image):?>
        <div class="attach-wrap bg-transparent">
            <a class="attach" href="#">
                <img src="<?=Yii::getAlias("/load/{$files->dir}/$image");?>">
            </a>
        </div>
        <?=Html::activeInput('hidden', $files, 'files[]', ['value' => $image]);?>
    <?endforeach;;
endif;?>

