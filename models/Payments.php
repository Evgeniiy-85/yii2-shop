<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\Files;
use app\modules\admin\models\ModelExtentions;
use Yii;
use yii\db\ActiveRecord;

class Payments extends ActiveRecord {
    use ModelExtentions;

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['pay_title'], 'required'],
            [['pay_title', 'pay_desc', 'pay_image'], 'string'],
            [['pay_status', 'pay_sort'], 'integer'],
            [['pay_title', 'pay_desc',], 'trim'],
        ];
    }


    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'pay_title' => 'Название',
            'pay_desc' => 'Описание',
            'pay_image' => 'Иконка',
            'pay_sort' => 'Порядок сортировки',
            'pay_status' => 'Статус',
        ];
    }

    /**
     * @param $insert
     * @return bool
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $files = new Files();
            $this->pay_image = $files->upload('payments') ?: $this->pay_image;

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
            self::STATUS_DISABLED => 'Отключен',
            self::STATUS_ACTIVE => 'Активен',
        ];

        return $status !== false ? $statuses[$status] : $statuses;
    }
}