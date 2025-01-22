<?php
use yii\helpers\Html;
use app\models\Category;
use app\models\Product;

$this->title = $category['cat_title'];
$this->params['breadcrumbs'] = Product::getBreadCrumbs($category);?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="categories-list">
        <?foreach ($subcategories as $subcategory):?>
            <a class="category-card" href="/categories/<?="{$category['cat_alias']}/{$subcategory['cat_alias']}";?>">
                <div class="card_cover">
                    <img src="/load/categories/<?=$subcategory['cat_image'];?>">
                </div>

                <div class="card_title"><?=$subcategory['cat_title'];?></div>
            </a>
        <?endforeach;?>
    </div>
</div>