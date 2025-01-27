<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;?>

<div class="c-card checkout-form">
    <?$form = ActiveForm::begin([
        'id' => 'form-product',
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]);?>

    <div class="c-card-body column-2">
        <?= $form->field($order, 'client_email')->input('email', ['autofocus' => true]); ?>
        <?= $form->field($order, 'client_name')->input('text'); ?>
        <?= $form->field($order, 'client_surname')->input('text'); ?>
        <?= $form->field($order, 'client_phone')->input('text'); ?>
    </div>

    <div class="c-card-footer text-right">
        <?= Html::submitButton('Продолжить', ['class' => 'button button-ui btn_a-primary button-small', 'name' => 'next']) ?>
    </div>

    <?ActiveForm::end();?>
</div>
