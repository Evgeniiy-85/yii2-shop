<?php
use yii\helpers\Html;
use app\components\Helpers;
use app\models\Products;

$this->title = isset($category) ? $category['cat_title'] : 'Каталог';
if (isset($category)) {
    $this->params['breadcrumbs'] = Products::getBreadCrumbs($category, null);
}?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="products-list">
        <?foreach ($products as $product):?>
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

                    <div class="product-by">
                        <a class="button button-ui" href="/buy/<?=$product['prod_alias'];?>">Купить</a>
                    </div>
                </div>
            </div>
        <?endforeach;?>
    </div>
</div>