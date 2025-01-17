<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\Files;
use app\modules\admin\models\ModelExtentions;
use Yii;
use yii\db\ActiveRecord;

class Products extends ActiveRecord {
    use ModelExtentions;

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @var mixed|string
     */
    private $prod_image;


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['prod_title',], 'required'],
            [['prod_title', 'prod_image'], 'string'],
            [['prod_status', 'prod_price',], 'integer'],
            [['prod_title', 'prod_alias',], 'trim'],
        ];
    }


    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'prod_id' => 'ID продукта',
            'prod_title' => 'Название',
            'prod_alias' => 'Алиас',
            'prod_image' => 'Обложка',
            'prod_price' => 'Цена',
            'prod_status' => 'Статус',
        ];
    }


    /**
     * @param $insert
     * @return bool
     */
    public function beforeSave($insert) {
        $files = new Files();
        $this->prod_image = $files->upload('products') ?: $this->prod_image;

        if (!$this->prod_id) {
            if (!$this->prod_alias) {
                $this->prod_alias = Helpers::Translit($this->prod_title);
            }

            $this->prod_alias = Helpers::generateUniqueAlias($this->prod_alias, $this, 'prod_alias');
        }

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
            self::STATUS_DISABLED => 'Отключен',
            self::STATUS_ACTIVE => 'Активен',
        ];

        return $status ? $statuses[$status] : $statuses;
    }
}