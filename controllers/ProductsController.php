<?php

namespace app\controllers;

use app\models\Categories;
use app\models\Products;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;

class ProductsController extends Controller {

    public function actionIndex() {
        $page_size = 36;

        $query = Products::find()->where(['prod_status' => [Products::STATUS_ACTIVE]]);
        $pages = new Pagination([
            'pageSize' => $page_size,
            'defaultPageSize' => $page_size,
            'totalCount' => $query->count()
        ]);

        $query
            ->orderBy(['prod_id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit);

        return $this->render('products', [
            'products' => $query->all(),
            'category' => null,
        ]);
    }


    public function actionProduct($alias) {
        $product = Products::find()->where(['prod_alias' => $alias])->one();
        if (!$product) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $category = null;
        if ($product['prod_category']) {
            $category = Categories::find()->where(['cat_id' => $product['prod_category']])->one();
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
