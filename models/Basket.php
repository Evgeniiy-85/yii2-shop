<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\Files;
use app\modules\admin\models\ModelExtentions;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Basket extends Model {
    public $total = 0;
    public $products = [];
    public $quantity = [];
    private $save_key = 'Basket';

    public function rules() {
        return [
            [['total', 'products', 'quantity',], 'safe'],
        ];
    }

    public function addToBasket(int $prod_id, int $quantity) {
        $this->setAttributes(Yii::$app->session->get($this->save_key, []));

        $product = $this->products[$product->prod_id] ?? Product::find()->where(['prod_status' => Product::STATUS_ACTIVE, 'prod_id' => $prod_id])->one();
        if (!$product) {
            return false;
        }

        if (!isset($this->products[$prod_id])) {
            $this->products[$prod_id] = $product;
            $this->quantity[$prod_id] = $quantity;
            $this->total = $product->prod_price;
        } else {
            $this->quantity[$prod_id] += $quantity;
            $this->total += $product->prod_price;
        }

        Yii::$app->session->set($this->save_key, $this->attributes);
    }
}