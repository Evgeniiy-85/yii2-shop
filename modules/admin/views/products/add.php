<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'form-product',
    'action' => "/admin/{$this->context->id}/add",
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]);?>

<?=$model->showNotices();?>

<div class="row">
    <div class="col-xs-4">
        <?= $form->field($model, 'prod_title')->input('text'); ?>
        <?= $form->field($model, 'prod_alias')->input('text'); ?>
        <?= $form->field($model, 'prod_image')->input('text'); ?>
        <?= $form->field($model, 'prod_price')->input('text'); ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'add']) ?>
    </div>
</div>

<?=Html::activeInput('hidden', $model, 'prod_id');

ActiveForm::end();

