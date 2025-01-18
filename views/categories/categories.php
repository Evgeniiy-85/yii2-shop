<?php
use yii\helpers\Html;

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="catalog-list-wrap">
        <div class="catalog-list">
            <?if($categories):
                foreach ($categories as $category):?>
                    <div class="product-card">
                        <a class="product-card_cover" href="/categories/<?=$category['cat_alias'];?>">
                            <?if($category['cat_image']):?>
                                <img src="/load/products/<?=$category['cat_image'];?>";?>
                            <?endif;?>
                        </a>

                        <div class="product-card_main">
                            <div class="product-card_title"><?=$category['cat_title'];?></div>

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

