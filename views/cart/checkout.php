<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Оформление заказа';?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <?$form = ActiveForm::begin([
                    'id' => 'form-product',
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ]
                ]);?>

                <div class="card-body">
                    <?= $form->field($order, 'client_email')->input('email', ['autofocus' => true]); ?>
                    <?= $form->field($order, 'client_name')->input('text'); ?>
                    <?= $form->field($order, 'client_surname')->input('text'); ?>
                    <?= $form->field($order, 'client_phone')->input('text'); ?>
                </div>

                <div class="card-footer text-right">
                    <?= Html::submitButton('Продолжить', ['class' => 'btn btn-primary', 'name' => 'next']) ?>
                </div>

                <?ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>