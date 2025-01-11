<?php

namespace app\controllers;

use app\models\Products;
use yii\data\Pagination;
use yii\web\Controller;

class ProductsController extends Controller {

    public function actionIndex() {
        return $this->render('index');
    }


    public function actionCatalog() {
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

        return $this->render('catalog', [
            'products' => $query->all(),
        ]);
    }


    public function actionBuy() {
        return $this->render('buy');
    }
}
