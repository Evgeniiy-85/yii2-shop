<?php
use yii\helpers\Html;
use app\components\Helpers;
use yii\helpers\Url;
use app\models\Product;?>

<div class="selected-products">
    <div class="block-header">
        <div class="cart-title">Список товаров</div>
    </div>

    <div class="block-body">
        <?foreach($order_items as $key => $order_item):
            $product = Product::find()->where(['prod_id' => $order_item->prod_id])->one();?>
            <div class="product">
                <div class="product-cover">
                    <img src="/load/products/<?=$product->prod_image;?>">
                </div>

                <div class="product-info">
                    <div class="product-title">
                        <?=Html::encode($product->prod_title);?><b><?=" ({$order_item->quantity}шт.)";?></b>
                    </div>
                    <div class="product-price"><nobr><?=Helpers::formatPrice($order_item->prod_price * $order_item->quantity);?> ₽</nobr></div>
                </div>
            </div><hr>
        <?endforeach;?>
    </div>

     <div class="block-footer">
        <div class="block-footer_left">
            <strong>Итого: </strong>
            <span><?=Helpers::formatPrice($order->order_sum);?></span>
        </div>
     </div>
</div>