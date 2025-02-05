<?php
use yii\helpers\Html;
use yii\jui\Sortable;
$items = [];?>

<?if($files->files):
    foreach ($files->files as $image):?>
        <?$items[] = [
            'content' => $this->render('part_item_images', [
                'files' => $files,
                'image' => $image
            ]),
            'options' => ['tag' => 'div', 'class' => 'attach-wrap sortable-handle'],
        ];
    endforeach;
endif;?>

<?$options = !isset($without_container) ? ['tag' => 'div', 'id' => 'attachments', 'class' => 'attachments', 'data-dir' => $files->dir] : ['tag' => false];
echo Sortable::widget([
    'items' => $items,
    'options' => $options,
    'itemOptions' => ['tag' => 'div'],
    'clientOptions' => ['cursor' => 'move'],
]);?>

