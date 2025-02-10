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
    public $logo;
    public $favicon;
    public $avatar;

    /* Папки для файлов */
    private static $dirs = [
        'favicon' => "/images", // favicon,
        'logo' => "/images", // Логотип сайта,
        'avatar' => "/load/avatars", // Аватары,
        'product' => "/load/products", // Товары,
        'category' => "/load/categories", // Категории,
        'payment' => "/load/payments", // Платежные модули,
    ];

    /**
     * @param $type
     * @return false|string
     */
    public function getDirPath($type) {
        $dir = self::$dirs[$type];
        return Yii::getAlias("@webroot/$dir");
    }

    /**
     * @param $type
     * @param $file_name
     * @return string
     */
    public function getPath($type, $file_name) {
        $dir = self::getDirPath($type);
        return "$dir/$file_name";
    }


    /**
     * @param $type
     * @param $file_name
     * @return string
     */
    public static function getRelativePath($type, $file_name) {
        $dir = self::$dirs[$type];
        return "$dir/$file_name";
    }
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['files', 'dir', 'file'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg,jpeg,webp,png', 'maxFiles' => 1, 'skipOnEmpty' => false],
            [['images'], 'file', 'extensions' => 'jpg,jpeg,webp,png', 'maxFiles' => 10, 'skipOnEmpty' => false],
            [['logo'], 'file', 'extensions' => 'png,svg', 'maxFiles' => 1, 'skipOnEmpty' => false],
            [['avatar'], 'file', 'extensions' => 'jpg,jpeg,png', 'maxFiles' => 1, 'skipOnEmpty' => false],
            [['favicon'], 'file', 'extensions' => 'ico,png', 'maxFiles' => 1, 'skipOnEmpty' => false],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'image' => 'Изображение',
            'images' => 'Изображения',
            'logo' => 'Логотип сайта',
            'avatar' => 'Аватар',
            'favicon' => 'Favicon',
        ];
    }


    /**
     * @param $type
     * @return false|string
     */
    public function uploadImage($type) {
        $this->image = UploadedFile::getInstance($this, 'image');
        if (!empty($this->image) && $this->validate()) {
            $path = $this->getPath($type, $this->image->name);
            return $this->image->saveAs($path) ? $this->image->name : false;
        }

        return false;
    }

    public function uploadLogo() {
        $this->logo = UploadedFile::getInstance($this, 'logo');
        if (!empty($this->logo) && $this->validate()) {
            $path = $this->getPath('logo', $this->logo->name);
            return $this->logo->saveAs($path) ? $this->logo->name : false;
        }

        return false;
    }

    public function uploadFavicon() {
        $this->favicon = UploadedFile::getInstance($this, 'favicon');
        if (!empty($this->favicon) && $this->validate()) {
            $path = $this->getPath('favicon', 'favicon.ico');
            return $this->favicon->saveAs($path) ? 'favicon.ico' : false;
        }

        return false;
    }

    public function uploadAvatar() {
        $this->avatar = UploadedFile::getInstance($this, 'avatar');
        if (!empty($this->avatar) && $this->validate()) {
            $path = $this->getPath('avatar', $this->avatar->name);
            return $this->avatar->saveAs($path) ? $this->avatar->name : false;
        }

        return false;
    }

    /**
     * @param $type
     * @return bool
     */
    public function uploadImages($type) {
        $this->images = UploadedFile::getInstances($this, 'images');

        if (!empty($this->images) && $this->validate()) {
            $dir_path = self::getDirPath($type);

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