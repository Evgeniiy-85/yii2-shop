<?php
use yii\helpers\Html;
use app\components\Helpers;
use yii\helpers\Url;
use app\models\Product;?>

<div class="order-products_list">
    <div class="order-header">
        <div class="cart-title">Список товаров</div>
    </div>

    <div class="order-body">
        <?foreach($order_items as $key => $order_item):
            $product = Product::find()->where(['prod_id' => $order_item->prod_id])->one();?>
            <?if($key !== 0):?>
                <hr>
            <?endif;?>

            <div class="order-product">
                <div class="order-product_cover">
                    <img src="/load/products/<?=$product->prod_image;?>">
                </div>

                <div class="order-product_info">
                    <div class="order-product_title">
                        <?=Html::encode($product->prod_title);?><b><?=" ({$order_item->quantity}шт.)";?></b>
                    </div>
                    <div class="order-product_price"><nobr><?=Helpers::formatPrice($order_item->prod_price * $order_item->quantity);?> руб.</nobr></div>
                </div>
            </div>
        <?endforeach;?>
    </div>

     <div class="cart-footer">
        <div class="cart-footer_left">
            <strong>Итого: </strong>
            <span><?=Helpers::formatPrice($order->order_sum);?></span>
        </div>
     </div>
</div>