<?php

namespace app\modules\admin\controllers;

use app\models\Order;
use app\models\Product;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\data\Pagination;
use Yii;
use yii\web\HttpException;

class OrdersController extends AdminController {
    public function actionIndex() {
        $page_size = 36;

        $query = Order::find();
        $pages = new Pagination([
            'pageSize' => $page_size,
            'defaultPageSize' => $page_size,
            'totalCount' => $query->count()
        ]);

        $query
            ->orderBy(['order_id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit);

        return $this->render('index', [
            'orders' => $query->all(),
        ]);
    }
}
