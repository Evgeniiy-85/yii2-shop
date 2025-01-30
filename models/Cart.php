<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\Files;
use app\modules\admin\models\ModelExtentions;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Cart extends Model {
    public $total = 0;
    public $products = [];
    public $quantity = [];
    private $save_key = 'cart';

    public function rules() {
        return [
            [['total', 'products', 'quantity',], 'safe'],
        ];
    }


    public function loadCart() {
        $this->setAttributes(Yii::$app->session->get($this->save_key, []));
    }

    /**
     * @param int $prod_id
     * @param int $quantity
     * @return bool
     */
    public function changeProduct(int $prod_id, int $quantity) {
        $this->loadCart();
        $product = $this->products[$prod_id] ?? Product::find()->where(['prod_status' => Product::STATUS_ACTIVE, 'prod_id' => $prod_id])->one();
        if (!$product) {
            return false;
        }

        $current_quantity = $this->quantity[$prod_id] ?? 0;
        $new_quantity = $quantity ? $current_quantity + $quantity : 0;

        if ($new_quantity == 0) {
            $this->total -= $product->prod_price * $current_quantity;
            unset($this->products[$prod_id]);
            unset($this->quantity[$prod_id]);

        } else {
            $this->total += $product->prod_price * $quantity;
            $this->products[$prod_id] = $product;
            $this->quantity[$prod_id] = $new_quantity;
        }

        Yii::$app->session->set($this->save_key, $this->attributes);
    }


    /**
     * @param int $prod_id
     * @return bool
     */
    public function removeProduct(int $prod_id) {
        $this->loadCart();
        $product = $this->products[$prod_id] ?? null;
        if (!$product) {
            return false;
        }

        if (!isset($this->products[$prod_id])) {
            $this->products[$prod_id] = $product;
            $this->quantity[$prod_id] = 1;
        } else {
            $this->quantity[$prod_id] += 1;
        }

        $this->total += $product->prod_price;
        Yii::$app->session->set($this->save_key, $this->attributes);

        return true;
    }


    /**
     * @param $prod_id
     * @param $quantity
     * @return bool
     */
    public function changeCountProducts($prod_id, $quantity) {
        $this->loadCart();
        if (!isset($this->products[$prod_id]) || !isset($this->quantity[$prod_id])) {
            return false;
        }

        $current_quantity = $this->quantity[$prod_id];
        $sum = $this->products[$prod_id]->prod_price * ($quantity - $current_quantity);

        if ($quantity > 0) {
            $this->quantity[$prod_id] = $quantity;
        } else {
            unset($this->products[$prod_id]);
            unset($this->quantity[$prod_id]);
        }

        $this->total += $sum;
        Yii::$app->session->set($this->save_key, $this->attributes);

        return true;
    }


    /**
     * @return true
     */
    public function remove() {
        Yii::$app->session->set($this->save_key, $this->attributes);

        return true;
    }
}