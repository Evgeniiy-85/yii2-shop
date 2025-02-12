<?php
use yii\helpers\Html;
use app\components\Helpers;
use app\models\Product;
use yii\helpers\Url;
use app\widgets\ReviewWidget;

$this->title = $product['prod_title'];
$this->params['breadcrumbs'] = Product::getBreadCrumbs($category, $product);?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="product-card">
        <div class="product-images-slider">
            <div class="images-thumbs">
                <?if($product['prod_images']):
                    foreach($product['prod_images'] as $key => $prod_image):?>
                        <div data-img_src="/load/products/<?=$prod_image;?>" class="image-thumb<?=$key == 0 ? ' active' : '';?>">
                            <?=Html::img(
                                "@web/load/products/{$prod_image}",
                                ['alt' => $product['prod_title']]
                            );?>
                        </div>
                    <?endforeach;
                endif;?>
            </div>

            <div class="images-main">
                <?=Html::img(
                    "@web/load/products/{$product['prod_image']}",
                    ['alt' => $product['prod_title']]
                );?>
            </div>
        </div>

        <div class="product-center">
            <a class="product-title" href="/products/<?=$product['prod_alias'];?>"><?=$product['prod_title'];?></a>

            <div class="product-by product-by-one_line">
                <div class="product-price">
                    <?=Helpers::formatPrice($product['prod_price']);?> ₽
                </div>

                <a class="button button-ui btn_a-outline-primary" href="/buy/<?=$product['prod_alias'];?>">Купить</a>
            </div>
            <div class="product-bottom">Наличите: в наличии</div>
        </div>
    </div>

    <div class="products-reviews_wrap">
        <?=ReviewWidget::widget(['prod_id' => $product['prod_id']]);?>
    </div>
</div>