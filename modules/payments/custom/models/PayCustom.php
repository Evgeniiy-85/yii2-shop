<?php

namespace app\modules\payments\custom\models;

use app\models\Payment;
use app\modules\admin\models\ModelExtentions;

class PayCustom extends Payment {
    use ModelExtentions;

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    public $organization;
    public $inn;
    public $bik;
    public $billing_number;
    public $address;


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['organization', 'organization', 'inn','bik', 'billing_number','address',], 'required'],
            [['organization', 'organization', 'inn','bik', 'billing_number','address',], 'string'],
            [['organization', 'organization', 'inn','bik', 'billing_number','address',], 'trim'],
        ];
    }


    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'organization' => 'Наименование организации:',
            'inn' => 'ИНН/КПП:',
            'bik' => 'БИК:',
            'billing_number' => 'Р/счёт:',
            'address' => 'Адрес для отправки закрывающих документов:',
        ];
    }

    /**
     * @return false|string
     */
    public function getFormParams() {
        $params = [
            'organization' => $this->organization,
            'inn' => $this->inn,
            'bik' => $this->bik,
            'billing_number' => $this->billing_number,
            'address' => $this->address,
        ];

        return json_encode($params);
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

    public static function tableName() {
        return 'payments';
    }

    /**
     * @param $status
     * @return int|int[]
     */
    public static function getStatuses($status = false) {
        $statuses = [
            self::STATUS_DISABLED => 'Отключен',
            self::STATUS_ACTIVE => 'Активен',
        ];

        return $status !== false ? $statuses[$status] : $statuses;
    }
}