<?php
use yii\helpers\Html;
use app\components\Helpers;?>

<?=Html::beginForm(['/order/checkout'], 'post', ['id' => 'form-add_to_basket']) ?>

<div class="cart-right_block">
    <div class="cart-item_header">
        <div class="cart-item_title">Состав заказа</div>
    </div>

    <div class="cart-item_title_wrap">
        <div class="cart-item_title">Товары (<?=count($cart->products);?>)</div>
        <div class="cart-item_price"><?=Helpers::formatPrice($cart->total);?></div>
    </div>

    <div class="cart-item">
        <div class="btn-group">
            <?= Html::submitButton('Перейти к оформлению', ['class' => 'button button-ui btn_a-primary', 'name' => 'apply']) ?>
        </div>
    </div>
</div>

<?=Html::endForm();?>
