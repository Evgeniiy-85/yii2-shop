<?php
use yii\helpers\Html;
use app\components\Helpers;
use yii\helpers\Url;
use app\models\Product;?>

<div class="order-products_list">
    <div class="order-header">
        <div class="cart-title">Товар</div>
    </div>

    <div class="order-body">
        <div class="order-product">
            <div class="order-product_cover">
                <img src="/load/products/<?=$product->prod_image;?>">
            </div>

            <div class="order-product_info">
                <div class="order-product_title">
                    <?=Html::encode($product->prod_title);?>
                </div>
                <div class="order-product_price"><nobr><?=Helpers::formatPrice($product->prod_price);?> руб.</nobr></div>
            </div>
        </div>
    </div>

    <div class="cart-footer">
        <div class="cart-footer_left">
            <strong>Итого: </strong>
            <span><?=Helpers::formatPrice($product->prod_price);?></span>
        </div>
    </div>
</div>