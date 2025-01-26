<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\Files;
use app\modules\admin\models\ModelExtentions;
use Yii;
use yii\db\ActiveRecord;

class OrderItems extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['order_id', 'prod_id', 'quantity'], 'required'],
            [['prod_title',], 'string'],
            [['order_id', 'prod_id', 'prod_price', 'quantity'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'order_items';
    }


    /**
     * @param $order
     * @param $product
     * @param $quantity
     * @return void
     */
    public function setData($order, $product, $quantity) {
        $this->setAttribute('order_id', $order->order_id);
        $this->setAttribute('prod_id', $product->prod_id);
        $this->setAttribute('prod_price', $product->prod_price);
        $this->setAttribute('prod_title', $product->prod_title);
        $this->setAttribute('quantity', $quantity);
    }
}