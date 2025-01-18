<?php

namespace app\modules\admin\controllers;

use app\models\Products;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\data\Pagination;
use Yii;
use yii\web\HttpException;

class OrdersController extends AdminController {
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

        return $this->render('index', [
            'products' => $query->all(),
        ]);
    }
}
