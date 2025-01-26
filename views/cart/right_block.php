<?php
use yii\helpers\Html;
use app\components\Helpers;
use yii\helpers\Url;?>

<?=Html::beginForm(['/cart/checkout'], 'post', ['id' => 'form-add_to_basket']) ?>

<div class="cart-right_block">
    <div class="cart-item_header">
        <div class="cart-item_title">Состав заказа</div>
    </div>

    <div class="cart-item_title_wrap">
        <div class="cart-item_title">Товары (<?=count($cart->products);?>)</div>
        <div class="cart-item_price"><?=Helpers::formatPrice($cart->total);?></div>
    </div>

    <div class="cart-item">
        <a href="<?=Url::to(['cart/checkout']);?>" class="button button-ui btn_a-primary">Перейти к оформлению</a>
    </div>
</div>

<?=Html::endForm();?>
