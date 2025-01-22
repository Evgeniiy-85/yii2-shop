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
            [['order_id', 'prod_id'], 'required'],
            [['prod_title',], 'string'],
            [['order_id', 'prod_id', 'prod_price'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'order_items';
    }
}