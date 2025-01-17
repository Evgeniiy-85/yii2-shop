<?php

namespace app\modules\admin\models;

use yii\base\Model;
use Yii;
use yii\web\UploadedFile;

class Files extends Model {
    public $image;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['image'], 'file', 'extensions' => 'jpg,jpeg,webp', 'maxFiles' => 1, 'skipOnEmpty' => false]
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'image' => 'Изображение',
        ];
    }


    /**
     * @param $path
     * @return false|string
     */
    public function upload($path) {
        $this->image = UploadedFile::getInstance($this, 'image');
        if (!empty($this->image) && $this->validate()) {
            $path = Yii::getAlias("@webroot/load/$path/{$this->image->name}");
            return $this->image->saveAs($path) ? $this->image->name : false;
        }

        return false;
    }
}