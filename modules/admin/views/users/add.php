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
        <?= $form->field($model, 'user_email')->input('text'); ?>
        <?= $form->field($model, 'user_name')->input('text'); ?>
        <?= $form->field($model, 'user_surname')->input('text'); ?>
        <?= $form->field($model, 'user_patronymic')->input('text'); ?>
        <?= $form->field($model, 'user_phone')->input('text'); ?>
        <?= $form->field($model, 'user_photo')->input('text'); ?>
        <?= $form->field($model, 'user_password')->input('text'); ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'add']) ?>
    </div>
</div>

<?ActiveForm::end();

