<?php
use yii\helpers\Html;
use app\models\Categories;

$this->title = 'Каталог';
if (isset($category)) {
    $this->title = $category->cat_title;
    $this->params['breadcrumbs'] = Categories::getBreadCrumbs($category);
}?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="categories-list">
        <?if($categories):
            foreach ($categories as $category):?>
                <a class="category-card" href="/categories/<?=$category['cat_alias'];?>">
                    <div class="card_cover">
                        <img src="/load/categories/<?=$category['cat_image'];?>">
                    </div>

                    <div class="card_title"><?=$category['cat_title'];?></div>
                </a>
            <?endforeach;
        endif;?>
    </div>
</div>

