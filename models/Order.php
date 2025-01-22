<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\Files;
use app\modules\admin\models\ModelExtentions;
use Yii;
use yii\db\ActiveRecord;
use app\models\Product;

class Order extends ActiveRecord {
    use ModelExtentions;

    const STATUS_NO_PAID = 0;
    const STATUS_PAID = 1;
    const STATUS_INVOICE_ISSUED = 3; // ВЫПИСАН СЧЕТ

    public $products = [];

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['client_email', 'client_name', 'client_surname', 'client_phone',], 'required'],
            [['client_email', 'client_name','client_surname', 'client_phone'], 'string'],
            [['order_date', 'payment_date',], 'integer'],
            [['client_email', 'client_name','client_surname', 'client_phone'], 'trim'],
        ];
    }


    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'client_email' => 'E-mail',
            'client_name' => 'Имя',
            'client_surname' => 'Фамилия',
            'client_phone' => 'Телефон',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'orders';
    }

    /**
     * @param $insert
     * @return bool
     */
    public function beforeSave($insert) {
        $this->order_date = time();
        if (parent::beforeSave($insert)) {
            return true;
        }

        return false;
    }

    public function afterFind() {
        parent::afterFind();
        $this->products = OrderItems::find()->where(['order_id' => $this->order_id])->all();
    }

    /**
     * @param $insert
     * @param $changedAttributes
     * @return bool
     * @throws \yii\db\Exception
     */
    public function afterSave($insert, $changedAttributes) {
        if (parent::beforeSave($insert, $changedAttributes)) {
            if ($this->products) {
                foreach ($this->products as $product) {
                    $model = new OrderItems();
                    $model->setAttribute('order_id', $this->order_id);
                    $model->setAttribute('prod_id', $this->prod_id);
                    $model->setAttribute('prod_price', $this->prod_price);
                    $model->setAttribute('prod_title', $this->prod_title);
                    $model->save();
                }
            }

            return true;
        }

        return false;
    }

    /**
     * @param $status
     * @return string|string[]
     */
    public static function getStatuses($status = false) {
        $statuses = [
            self::STATUS_PAID => 'Оплачен',
            self::STATUS_NO_PAID => 'Не оплачен',
        ];

        return $status !== false ? $statuses[$status] : $statuses;
    }
}