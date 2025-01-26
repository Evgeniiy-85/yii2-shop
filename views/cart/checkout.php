<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Оформление заказа';?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-9">
            <?=$this->render('cart_products', [
                'order' => $order,
                'cart' => $cart,
            ]);?>
        </div>

        <div class="col-md-9" style="margin-top: 40px;">
            <div class="card checkout-form_wrap">
                <div class="row">
                    <div class="col-md-7">
                        <?$form = ActiveForm::begin([
                            'id' => 'form-checkout',
                            'options' => [
                                'enctype' => 'multipart/form-data'
                            ]
                        ]);?>

                        <div class="card-body">
                            <?= $form->field($order, 'client_email')->input('email', ['autofocus' => true]); ?>
                            <?= $form->field($order, 'client_name')->input('text'); ?>
                            <?= $form->field($order, 'client_surname')->input('text'); ?>
                            <?= $form->field($order, 'client_phone')->input('text'); ?>

                            <div class="mt-4">
                                <?= Html::submitButton('Подвердить заказ', ['class' => 'button button-ui btn_a-primary button-small', 'name' => 'next']) ?>
                            </div>
                        </div>
                        <?ActiveForm::end();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>