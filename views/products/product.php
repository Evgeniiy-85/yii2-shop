<?php
use yii\helpers\Html;
use app\components\Helpers;
use app\models\Product;
use yii\helpers\Url;
use app\widgets\ReviewWidget;
use app\components\UI;

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
            <div class="product-title" href="/products/<?=$product['prod_alias'];?>"><?=$product['prod_title'];?></div>

            <div class="product-stat">
                <a class="product-rating" href="#product_reviews">
                    <?if($count_reviews):?>
                        <?=UI::rating($product_rating);?>
                        <?="&nbsp;{$count_reviews} ".Helpers::addTermination($count_reviews, 'отзыв[TRMNT]');?>
                    <?else:
                        $img = Html::tag('img','', ['class' => 'sale', 'src' => '/images/icons/rating-star-empty.svg',]);
                        echo Html::tag('div', $img, ['class' => 'rating-item']);
                        echo "&nbsp;нет отзывов"?>
                    <?endif;?>
                </a>
            </div>

            <div class="product-by product-by-one_line">
                <div class="product-price">
                    <?=Helpers::formatPrice($product['prod_price']);?> ₽
                </div>

                <div class="product-buttons">
                    <div class="product-favorites">
                        <?=Html::button('', [
                            'class' => ['button', 'button-ui', 'btn_a-grey'],
                            'type' => 'button',
                            'data' => [
                                'prod_id' => $product['prod_id'],
                                'action_type' => 'add',
                            ],
                        ]);?>
                    </div>

                    <a class="button button-ui btn_a-outline-primary" href="/buy/<?=$product['prod_alias'];?>">Купить</a>
                </div>
            </div>
            <div class="product-bottom">Наличите: в наличии</div>
        </div>
    </div>

    <div class="products-reviews_wrap" id="product_reviews">
        <?=ReviewWidget::widget(['prod_id' => $product['prod_id']]);?>
    </div>
</div>