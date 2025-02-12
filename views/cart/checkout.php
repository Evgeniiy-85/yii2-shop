<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Оформление заказа';?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-xl-7 col-lg-8 mb-5">
            <?=$this->render('cart_products', [
                'order' => $order,
                'cart' => $cart,
            ]);?>
        </div>

        <?if($cart->products):?>
            <div class="col-xl-7 col-lg-8">
                <?=$this->render('/order/checkout_form', [
                    'order' => $order,
                ]);?>
            </div>
        <?endif;?>
    </div>
</div>