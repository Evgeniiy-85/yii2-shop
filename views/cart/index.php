<?php
use yii\helpers\Html;
use app\components\Helpers;
use app\models\Product;

$this->title = 'Корзина';?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="products">
        <div class="products-list">
            <?if($cart->products):
                foreach ($cart->products as $product):?>
                    <div class="product-card">
                        <div class="product_cover">
                            <img src="/load/products/<?=$product['prod_image'];?>">
                        </div>

                        <div class="product-card_center">
                            <a class="product-card_title" href="/products/<?=$product['prod_alias'];?>"><?=$product['prod_title'];?></a>

                            <div class="card_bottom">Наличите: в наличии</div>
                        </div>

                        <div class="product-card_right">
                            <div class="product-price">
                                <?=Helpers::formatPrice($product['prod_price']);?> ₽
                            </div>
                        </div>
                    </div>
                <?endforeach;
            else:?>
                <div class="products-empty_result">
                    <h3>Ничего не найдено</h3>
                </div>
            <?endif;?>
        </div>

        <div class="cart-right-block_wrap">
            <?=$this->render('right_block', [
                'cart' => $cart,
            ]);?>
        </div>
    </div>
</div>