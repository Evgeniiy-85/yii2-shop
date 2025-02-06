<?php

namespace app\modules\admin\models;

use yii\base\Model;
use Yii;
use yii\web\UploadedFile;

class Files extends Model {
    public $image;
    public $images;
    public $files = [];
    public $file;
    public $dir;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['files', 'dir', 'file'], 'safe'],
            [['dir'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,jpeg,webp,png', 'maxFiles' => 1, 'skipOnEmpty' => false],
            [['images'], 'file', 'extensions' => 'jpg,jpeg,webp,png', 'maxFiles' => 10, 'skipOnEmpty' => false]
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'image' => 'Изображение',
            'images' => 'Изображения',
        ];
    }


    /**
     * @return void
     */
    public function uploadImage() {
        $this->image = UploadedFile::getInstance($this, 'image');
        if (!empty($this->image) && $this->validate()) {
            $path = Yii::getAlias("@webroot/load/{$this->dir}/{$this->image->name}");
            return $this->image->saveAs($path) ? $this->image->name : false;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function uploadImages() {
        $this->images = UploadedFile::getInstances($this, 'images');

        if (!empty($this->images) && $this->validate()) {
            $dir_path = Yii::getAlias("@webroot/load/{$this->dir}");

            foreach ($this->images as $image) {
                $path = "$dir_path/{$image->name}";
                if ($image->saveAs($path)) {
                    $this->files[] = $image->name;
                }
            }

            return true;
        }

        return false;
    }


    /**
     * @param $files
     * @param $dir
     * @return bool
     */
    public static function delFiles($files, $dir) {
        $success = [];

        if ($files) {
            $dir_path = Yii::getAlias("@webroot/load/{$dir}");
            foreach ($files as $file_name) {
                $path = "$dir_path/{$file_name}";
                if (unlink($path)) {
                    $success[] = true;
                }
            }

            return count($files) == count($success);
        }

        return true;
    }
}