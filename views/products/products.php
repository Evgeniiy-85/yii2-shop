<?php
use yii\helpers\Html;
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

        <?=$this->render('products_list', [
            'products' => $products,
        ]);?>
    </div>
</div>