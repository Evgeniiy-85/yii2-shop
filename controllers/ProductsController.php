<?php

namespace app\controllers;

use app\models\Category;
use app\models\Favorites;
use app\models\Product;
use app\models\ProductFilter;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;
use Yii;

class ProductsController extends Controller {

    public function actionSearch() {
        $query = Product::find()->where([
            'prod_status' => [Product::STATUS_ACTIVE],
        ]);

        $filter = new ProductFilter();
        if (Yii::$app->request->get('filter') == 'apply' && $filter->load(Yii::$app->request->get()) && $filter->validate()) {
            $filter->add($query);
        }

        if (Yii::$app->request->get('q')) {
            Product::search(urldecode(Yii::$app->request->get('q')), $query);
        }

        $product_count = $query->count();

        return $this->render('search', [
            'products' => $query->all(),
            'product_count' => $product_count,
            'filter' => $filter,
        ]);
    }


    public function actionProduct($alias) {
        $product = Product::find()->where(['prod_alias' => $alias])->one();
        if (!$product) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $category = null;
        if ($product['prod_category']) {
            $category = Category::find()->where(['cat_id' => $product['prod_category']])->one();
        }

        return $this->render('product', [
            'product' => $product,
            'category' => $category,
        ]);
    }


    public function actionBuy() {
        return $this->render('buy');
    }
}
