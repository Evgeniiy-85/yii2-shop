<?php

namespace app\controllers;

use app\models\Products;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;

class ProductsController extends Controller {

    public function actionIndex() {
        $pageSize = 36;

        $query = Products::find()->where(['prod_status' => [Products::STATUS_ACTIVE]]);
        $pages = new Pagination([
            'pageSize' => $pageSize,
            'defaultPageSize' => $pageSize,
            'totalCount' => $query->count()
        ]);

        $query
            ->orderBy(['prod_id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit);

        return $this->render('products', [
            'products' => $query->all(),
        ]);
    }


    public function actionProduct($alias) {
        $product = Products::find()->where(['prod_alias' => $alias])->one();
        if (!$product) {
            throw new HttpException(404, "Страница не найдена.");
        }

        return $this->render('product', [
            'product' => $product,
        ]);
    }


    public function actionBuy() {
        return $this->render('buy');
    }
}
