<?php
use yii\helpers\Html;
use app\models\Categories;

$this->title = $category['cat_title'];
$this->params['breadcrumbs'] = Categories::getBreadCrumbs($category);?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="categories">
        <?if($subcategories):
            foreach ($subcategories as $subcategory):?>
                <a class="category-card" href="/categories/<?="{$category['cat_alias']}/{$subcategory['cat_alias']}";?>">
                    <div class="card_cover">
                        <img src="/load/categories/<?=$subcategory['cat_image'];?>">
                    </div>

                    <div class="card_title"><?=$subcategory['cat_title'];?></div>
                </a>
            <?endforeach;
        elseif($products):
            foreach ($products as $product):?>
                <a class="category-card" href="/products/<?=$product['prod_alias'];?>">
                    <div class="card_cover">
                        <img src="/load/products/<?=$product['prod_image'];?>">
                    </div>

                    <div class="card_title"><?=$product['prod_title'];?></div>
                </a>
            <?endforeach;
        endif;?>
    </div>
</div>