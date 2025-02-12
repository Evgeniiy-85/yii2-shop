<?php
use yii\helpers\Html;
use app\components\Helpers;
use app\models\Product;
use yii\helpers\Url;

$this->title = 'Корзина';?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-9">
            <?=$this->render('cart_products', [
                'cart' => $cart,
            ]);?>
        </div>
    </div>
</div>