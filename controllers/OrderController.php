<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;
use app\models\Payment;
use app\models\Product;
use app\controllers\BaseController;
use yii\web\HttpException;
use Yii;

class OrderController extends BaseController {

    public function actionBuy($alias) {
        $this->setShowHeaderMenu(false);

        $product = Product::find()->where(['prod_alias' => $alias])->one();
        if (!$product) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $order = new Order();
        if ($order->load(Yii::$app->request->post()) && $order->validate()) {
            $order->setAttribute('order_sum', $product->prod_price);
            if ($order->save()) {
                $order_items = new OrderItems();
                $order_items->setData($order, $product, 1);
                $order_items->save();
                $this->redirect("/pay/{$order->order_id}");
            }
        }

        return $this->render('buy', [
            'product' => $product,
            'order' => $order,
        ]);
    }


    public function actionCheckout() {
        exit;

        return $this->render('checkout', [

        ]);
    }


    /**
     * @param $ID
     * @return string
     * @throws HttpException
     */
    public function actionPay($ID) {
        $this->setShowHeaderMenu(false);

        $order = Order::find()->where(['order_id' => $ID, 'order_status' => Order::STATUS_NO_PAID])->one();
        if (!$order) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $order_items = OrderItems::find()->where(['order_id' => $ID])->all();
        $payments = Payment::find()->where(['pay_status' => Payment::STATUS_ACTIVE])->all();

        $cart = new Cart();
        $cart->remove();

        return $this->render('pay', [
            'order' => $order,
            'order_items' => $order_items,
            'products' => $order->products,
            'payments' => $payments,
        ]);
    }


    public function actionSuccess() {
        return $this->render('success');
    }
}
