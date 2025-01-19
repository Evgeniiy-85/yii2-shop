<?php
use yii\helpers\Html;
use app\models\Categories;

$this->title = $category['cat_title'];
$this->params['breadcrumbs'] = Categories::getBreadCrumbs($category);?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>
        <?if($subcategories) {
            echo $this->render('categories_list', [
                'category' => $category,
                'subcategories' => $subcategories
            ]);
        } elseif($products) {
            echo $this->render('products_list', [
                'category' => $category,
                'products' => $products,
            ]);
        }?>
    </div>
</div>