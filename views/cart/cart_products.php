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
        <?$first_key = array_key_first($cart->products);
        foreach($cart->products as $prod_id => $product):
            $quantity = $cart->quantity[$prod_id];;?>
            <?if($prod_id !== $first_key):?>
                <hr>
            <?endif;?>

            <div class="order-product">
                <div class="order-product_cover">
                    <img src="/load/products/<?=$product->prod_image;?>">
                </div>

                <div class="order-product_info">
                    <div class="order-product_title">
                        <?=Html::encode($product->prod_title);?><b><?=" ({$quantity}шт.)";?></b>
                    </div>
                    <div class="order-product_price"><nobr><?=Helpers::formatPrice($product->prod_price * $quantity);?> руб.</nobr></div>
                </div>
            </div>
        <?endforeach;?>
    </div>

     <div class="cart-footer">
        <div class="cart-footer_left">
            <strong>Итого: </strong>
            <span><?=Helpers::formatPrice($cart->total);?></span>
        </div>

         <?if(Yii::$app->controller->action->id == 'index'):?>
             <div>
                 <a href="<?=Url::to(['cart/checkout']);?>" class="button button-ui btn_a-primary button-small">Перейти к оформлению</a>
             </div>
         <?endif;?>
     </div>
</div>