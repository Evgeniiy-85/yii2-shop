<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Products extends ActiveRecord {
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['prod_alias', 'prod_title',], 'required'],
            [['prod_title', 'prod_image'], 'string'],
            [['prod_status', 'prod_price',], 'integer'],
            [['prod_title', 'prod_alias',], 'trim'],
        ];
    }


    /**
     * @param $insert
     * @return bool
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            return true;
        }

        return false;
    }
}