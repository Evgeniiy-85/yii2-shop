<?php
namespace app\controllers;

use Yii;
use app\models\Basket;
use yii\web\Controller;

class BasketController extends Controller {

    public function actionIndex() {

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

            $basket = new Basket();
            if ($basket->addToBasket($prod_id, $quantity)) {
                return $this->render('modal', ['basket' => $basket]);
            }
        }
    }


    public function actionQuantityChange() {
        if (Yii::$app->request->isAjax && $data = Yii::$app->request->post()) {
            $this->layout = false;

            $prod_id = (int)$data['prod_id'] ?? null;
            $quantity = (int)$data['quantity'] ?? null;
            if (!$prod_id || $quantity === null) {
                exit;
            }

            $basket = new Basket();
            if ($basket->quantityChange($prod_id, $quantity)) {
                return $this->render('modal', ['basket' => $basket]);
            }
        }
    }


    public function actionRemove() {
        if (Yii::$app->request->isAjax && $data = Yii::$app->request->post()) {
            $this->layout = false;

            $basket = new Basket();
            return $basket->remove();
        }
    }
}