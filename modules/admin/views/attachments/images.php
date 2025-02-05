<?php
use yii\helpers\Html;
use yii\jui\Sortable;

$items = [];?>

<?if($files->files):
    foreach ($files->files as $image):?>
        <?$items[] = [
            'content' => $this->render('part_item_images', [
                'files' => $files,
                'dir' => 'products',
                'image' => $image
            ]),
            'options' => ['tag' => 'div', 'class' => 'attach-wrap bg-transparent sortable-handle'],
        ];
    endforeach;
endif;?>

<?=Sortable::widget([
    'items' => $items,
    'options' => ['tag' => 'div', 'id' => 'attachments', 'class' => 'attachments', 'data-dir' => $dir],
    'itemOptions' => ['tag' => 'div'],
    'clientOptions' => ['cursor' => 'move'],
]);?>

