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
    public static function tableName() {
        return 'order_items';
    }
}