<?php
use yii\helpers\Html;
use app\components\Helpers;
use yii\helpers\Url;
use app\models\Product;?>

<div class="selected-products">
    <?if($cart->products):?>
        <div class="block-header">
            <div class="block-title">Список товаров</div>
        </div>

        <div class="block-body">
            <?foreach($cart->products as $prod_id => $product):
                $quantity = $cart->quantity[$prod_id];?>
                <div class="product">
                    <div class="product-cover">
                        <img src="/load/products/<?=$product->prod_image;?>">
                    </div>

                    <div class="product-info">
                        <div class="product-title">
                            <?=Html::encode($product->prod_title);?><b><?=" ({$quantity}шт.)";?></b>
                        </div>
                        <div class="product-price"><nobr><?=Helpers::formatPrice($product->prod_price * $quantity);?> ₽</nobr></div>
                    </div>
                </div><hr>
            <?endforeach;?>
        </div>

         <div class="block-footer">
            <div class="block-footer_left">
                <strong>Итого: </strong>
                <span><?=Helpers::formatPrice($cart->total);?></span>
            </div>

             <?if(Yii::$app->controller->action->id == 'index'):?>
                 <div>
                     <a href="<?=Url::to(['cart/checkout']);?>" class="button button-ui btn_a-primary button-small">Перейти к оформлению</a>
                 </div>
             <?endif;?>
         </div>
    <?else:?>
        <div class="empty-result">
            <h3>Корзина пуста</h3>
        </div>
    <?endif;?>
</div>