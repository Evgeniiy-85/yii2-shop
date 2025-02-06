<?php
namespace app\controllers;

use app\models\Order;
use app\models\OrderItems;
use app\models\Product;
use Yii;
use app\models\Cart;
use app\controllers\BaseController;

class CartController extends BaseController {

    public function actionIndex() {
        $cart = new Cart();
        $cart->loadCart();

        return $this->render('index', ['cart' => $cart]);
    }

    /**
     * @return string|void
     */
    public function actionAdd() {
        if (Yii::$app->request->isAjax && $data = Yii::$app->request->post()) {
            $this->layout = false;

            $prod_id = (int)$data['prod_id'] ?? null;
            $quantity = (int)$data['quantity'] ?? null;
            if (!$prod_id || !$quantity) {
                exit;
            }

            $cart = new Cart();
            if ($cart->addProduct($prod_id, $quantity)) {
                return $this->render('modal', ['cart' => $cart]);
            }
        }
    }


    public function actionActions() {
        if (Yii::$app->request->isAjax && $data = Yii::$app->request->post()) {
            if (!isset($data['action_type'])) {
                exit;
            }

            $this->layout = false;
            $cart = new Cart();
            $prod_id = isset($data['prod_id']) ? (int)$data['prod_id'] : null;

            switch($data['action_type']) {
                case 'get':
                    $cart->loadCart();
                    break;
                case 'append':
                    $cart->changeProduct($prod_id, 1);
                    break;
                case 'reduce':
                    $cart->changeProduct($prod_id, -1);
                    break;
                case 'product_remove':
                    $cart->changeProduct($prod_id, 0);
                    break;
                case 'cart_remove':
                    $cart->remove();
                    break;
            }

            if ($cart->total) {
                return $this->render('modal', ['cart' => $cart]);
            }
        }
    }

    public function actionRemove() {
        if (Yii::$app->request->isAjax && $data = Yii::$app->request->post()) {
            $this->layout = false;

            $cart = new Cart();
            return $cart->remove();
        }
    }

    public function actionCheckout() {
        $this->setShowHeaderMenu(false);

        $cart = new Cart();
        $cart->loadCart();
        $order = new Order();

        if ($order->load(Yii::$app->request->post()) && $order->validate()) {
            $order->setAttribute('order_sum', $cart->total);

            if ($order->save()) {
                foreach ($cart->products as $prod_id => $product) {
                    $order_items = new OrderItems();
                    $order_items->setData($order, $product, $cart->quantity[$prod_id]);
                    $order_items->save();
                }

                $this->redirect("/pay/{$order->order_id}");
            }

            if ($order->save()) {
                $this->redirect("/pay/{$order->order_id}");
            }
        }

        return $this->render('checkout', [
            'cart' => $cart,
            'order' => $order,
        ]);
    }
}
