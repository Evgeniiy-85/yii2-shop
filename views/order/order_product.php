<?php
use yii\helpers\Html;
use app\components\Helpers;
use yii\helpers\Url;
use app\models\Product;?>

<div class="selected-products">
    <div class="block-header">
        <div class="block-title">Товар</div>
    </div>

    <div class="block-body">
        <div class="product">
            <div class="product-cover">
                <img src="/load/products/<?=$product->prod_image;?>">
            </div>

            <div class="product-info">
                <div class="product-title">
                    <?=Html::encode($product->prod_title);?>
                </div>
                <div class="product-price"><nobr><?=Helpers::formatPrice($product->prod_price);?> ₽</nobr></div>
            </div>
        </div>
    </div>

    <div class="block-footer">
        <div class="block-footer_left">
            <strong>Итого: </strong>
            <span><?=Helpers::formatPrice($product->prod_price);?></span>
        </div>
    </div>
</div>