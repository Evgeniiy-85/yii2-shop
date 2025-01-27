<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Оформление заказа';?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-7 mb-5">
            <?=$this->render('cart_products', [
                'order' => $order,
                'cart' => $cart,
            ]);?>
        </div>

        <div class="col-md-7">
            <?=$this->render('/order/checkout_form', [
                'order' => $order,
            ]);?>
        </div>
    </div>
</div>