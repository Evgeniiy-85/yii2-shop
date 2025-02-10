<?php
use yii\helpers\Html;
use yii\jui\Sortable;
$items = [];?>

<?if($images) {
    foreach ($images as $image) {
        $items[] = [
            'content' => $this->render('part_item_images', [
                'type' => $type,
                'image' => $image,
                'files' => $files,
            ]),
            'options' => ['tag' => 'div', 'class' => 'attach-wrap sortable-handle'],
        ];
    }
}?>

<?$options = !isset($without_container) ? ['tag' => 'div', 'id' => 'attachments', 'class' => 'attachments', 'data-type' => $type] : ['tag' => false];
echo Sortable::widget([
    'items' => $items,
    'options' => $options,
    'itemOptions' => ['tag' => 'div'],
    'clientOptions' => ['cursor' => 'move'],
]);?>

