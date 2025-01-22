<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\Files;
use app\modules\admin\models\ModelExtentions;
use Yii;
use yii\db\ActiveRecord;

class Order extends ActiveRecord {
    use ModelExtentions;

    const STATUS_NO_PAID = 0;
    const STATUS_PAID = 1;
    const STATUS_INVOICE_ISSUED = 3; // ВЫПИСАН СЧЕТ

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

    /**
     * @param $status
     * @return int|int[]
     */
    public static function getStatuses($status = false) {
        $statuses = [
            self::STATUS_PAID => 'Оплачен',
            self::STATUS_NO_PAID => 'Не оплачен',
        ];

        return $status !== false ? $statuses[$status] : $statuses;
    }


    /**
     * @param $status
     * @return void
     */
    public function setStatus($status) {
        $this->order_status = $status;
    }
}