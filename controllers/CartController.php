<?php
namespace app\controllers;

use Yii;
use app\models\Cart;
use yii\web\Controller;

class CartController extends Controller {

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


    public function actionChange() {
        if (Yii::$app->request->isAjax && $data = Yii::$app->request->post()) {
            $this->layout = false;

            $prod_id = (int)$data['prod_id'] ?? null;
            $quantity = (int)$data['quantity'] ?? null;
            if (!$prod_id || $quantity === null) {
                exit;
            }

            $cart = new Cart();
            if ($cart->changeCountProducts($prod_id, $quantity)) {
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

    }
}
