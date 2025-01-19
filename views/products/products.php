<?php
use yii\helpers\Html;

$this->title = 'Катало222г';
$this->params['breadcrumbs'][] = $this->title;?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="catalog-list-wrap">
        <div class="catalog-list">
            <?if($products):
                foreach ($products as $product):?>
                    <div class="product-card">
                        <a class="product-card_cover" href="/products/<?=$product['prod_alias'];?>">
                            <?if($product['prod_image']):?>
                                <img src="/load/products/<?=$product['prod_image'];?>";?>
                            <?endif;?>
                        </a>

                        <div class="product-card_main">
                            <div class="product-card_price"><?=$product['prod_price'];?></div>
                            <div class="product-card_title"><?=$product['prod_title'];?></div>

                            <div class="product-card_button_wrap">
                                <button class="product-card_button">В корзину</button>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
            <?endif;?>
        </div>
    </div>
</div>

