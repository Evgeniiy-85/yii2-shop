<?php
use yii\helpers\Html;

$this->title = $product['prod_title'];
$this->params['breadcrumbs'][] = $this->title;?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="catalog-list">
        <div class="product-card">
            <a class="product-card_cover" href="/product/<?=$product['prod_alias'];?>">
                <img src="/images/product/<?=$product['prod_image'];?>";?>
            </a>

            <div class="product-card_main">
                <div class="product-card_price"><?=$product['prod_price'];?></div>
                <div class="product-card_title"><?=$product['prod_title'];?></div>

                <div class="product-card_button_wrap">
                    <button class="product-card_button">В корзину</button>
                </div>
            </div>
        </div>
    </div>
</div>

