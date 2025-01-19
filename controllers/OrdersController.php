<?php

namespace app\controllers;

use app\models\Orders;
use app\models\Products;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;
use Yii;

class OrdersController extends Controller {

    public function actionBuy($alias) {
        $product = Products::find()->where(['prod_alias' => $alias])->one();
        if (!$product) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $order = new Orders();
        if ($order->load(Yii::$app->request->post()) && $order->validate()) {
            $order->prod_id = $product->prod_id;
            if ($order->save()) {
                $this->redirect("/pay/{$order->order_id}");
            }

        }

        return $this->render('buy', [
            'product' => $product,
            'order' => $order,
        ]);
    }


    public function actionPay($ID) {
        $order = Orders::find()->where(['order_id' => $ID])->one();
        if (!$order) {
            throw new HttpException(404, "Страница не найдена.");
        }


    }
}
