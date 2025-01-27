<?php
use yii\helpers\Html;
use app\components\Helpers;
use app\models\Product;

$this->title = $product['prod_title'];
$this->params['breadcrumbs'] = Product::getBreadCrumbs($category, $product);?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="product">
        <div class="product-card">
            <div class="product-cover">
                <img src="/load/products/<?=$product['prod_image'];?>">
            </div>

            <div class="product-card_center">
                <a class="product-card-title" href="/products/<?=$product['prod_alias'];?>"><?=$product['prod_title'];?></a>

                <div class="product-by product-by-one_line">
                    <div class="product-price">
                        <?=Helpers::formatPrice($product['prod_price']);?> ₽
                    </div>

                    <a class="button button-ui btn_a-outline-primary" href="/buy/<?=$product['prod_alias'];?>">Купить</a>
                </div>
                <div class="card_bottom">Наличите: в наличии</div>
            </div>

            <div class="product-card_right">



            </div>
        </div>
    </div>
</div>