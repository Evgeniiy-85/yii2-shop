<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\Files;
use app\modules\admin\models\ModelExtentions;
use backend\models\Attachments;
use backend\models\Manufacturers;
use Yii;
use yii\db\ActiveRecord;

class Categories extends ActiveRecord {
    use ModelExtentions;

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cat_title',], 'required'],
            [['cat_title', 'cat_image'], 'string'],
            [['cat_status', 'cat_sort', 'cat_parent'], 'integer'],
            [['cat_title', 'cat_alias',], 'trim'],
        ];
    }


    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'cat_id' => 'ID категории',
            'cat_title' => 'Название',
            'cat_alias' => 'Алиас',
            'cat_image' => 'Обложка',
            'cat_status' => 'Статус',
            'cat_sort' => 'Сортировка',
            'cat_parent' => 'Родительская категория'
        ];
    }


    /**
     * @param $insert
     * @return bool
     */
    public function beforeSave($insert) {
        $this->cat_parent = (int)$this->cat_parent;

        if (parent::beforeSave($insert)) {
            $files = new Files();
            $this->cat_image = $files->upload('categories') ?: $this->cat_image;

            if (!$this->cat_id) {
                if (!$this->cat_alias) {
                    $this->cat_alias = Helpers::Translit($this->cat_title);
                }

                $this->cat_alias = Helpers::generateUniqueAlias($this->cat_alias, $this, 'cat_alias');
            }

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


    /**
     * @return void
     */
    public function init() {
        parent::afterFind();
        $this->cat_sort = (int)self::find()->max('cat_sort') + 1;
    }
}