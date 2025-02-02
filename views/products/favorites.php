<?php
use yii\helpers\Html;
use app\components\Helpers;
use app\models\Product;

$this->title = "Избранное";
$this->params['breadcrumbs'] = [$this->title];?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="products">
        <?=$this->render('products_list', [
            'products' => $products,
        ]);?>
    </div>
</div>

<?=$this->render('cart_modal');?>