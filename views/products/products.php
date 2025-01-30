<?php
use yii\helpers\Html;
use app\components\Helpers;
use app\models\Product;

$this->title = isset($category) ? $category['cat_title'] : 'Каталог';
if (isset($category)) {
    $this->params['breadcrumbs'] = Product::getBreadCrumbs($category, null);
}?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="products">
        <div class="products-filter_wrap">
            <?=$this->render('filter', [
                'filter' => $filter,
            ]);?>
        </div>

        <div class="products-list">
            <?if($products):
                foreach ($products as $product):?>
                    <div class="product">
                        <div class="product-cover">
                            <img src="/load/products/<?=$product['prod_image'];?>">
                        </div>

                        <div class="product-center">
                            <a class="product-title" href="/products/<?=$product['prod_alias'];?>"><?=$product['prod_title'];?></a>

                            <div class="card-bottom">Наличите: в наличии</div>
                        </div>

                        <div class="product-right">
                            <div class="product-price">
                                <?=Helpers::formatPrice($product['prod_price']);?> ₽
                            </div>

                            <div class="product-by">
                                <button type="button" class="button button-ui btn_a-outline-primary" data-prod_id="<?=$product['prod_id'];?>" data-action_type="append">Купить</button>
                            </div>
                        </div>
                    </div>
                <?endforeach;
            else:?>
                <div class="empty-result">
                    <h3>Ничего не найдено</h3>
                </div>
            <?endif;?>
        </div>
    </div>
</div>