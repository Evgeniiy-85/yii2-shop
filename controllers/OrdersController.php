<?php

namespace app\controllers;

use app\models\Order;
use app\models\Payment;
use app\models\Product;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;
use Yii;

class OrdersController extends Controller {

    public function actionBuy($alias) {
        $product = Product::find()->where(['prod_alias' => $alias])->one();
        if (!$product) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $order = new Order();
        if ($order->load(Yii::$app->request->post()) && $order->validate()) {
            $order->products = [$product];
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
        $order = Order::find()->where(['order_id' => $ID, 'order_status' => Order::STATUS_NO_PAID])->one();
        if (!$order) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $payments = Payment::find()->where(['pay_status' => Payment::STATUS_ACTIVE])->all();

        return $this->render('pay', [
            'order' => $order,
            'products' => $order->products,
            'payments' => $payments,
        ]);
    }


    public function actionSuccess() {
        return $this->render('success', [

        ]);
    }
}
