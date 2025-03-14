<?php
use yii\helpers\Html;
use app\models\Category;
use app\models\Product;

$this->title = 'Каталог';
if (isset($category)) {
    $this->title = $category->cat_title;
    $this->params['breadcrumbs'] = Product::getBreadCrumbs($category);
}?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="categories-list">
        <?if($categories):
            foreach ($categories as $category):?>
                <a class="category" href="/categories/<?=$category['cat_alias'];?>">
                    <div class="category-cover">
                        <img src="/load/categories/<?=$category['cat_image'];?>">
                    </div>

                    <div class="category-title"><?=$category['cat_title'];?></div>
                </a>
            <?endforeach;
        endif;?>
    </div>
</div>