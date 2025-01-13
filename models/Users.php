<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\ModelExtentions;
use yii\db\ActiveRecord;

class Users extends ActiveRecord {
    use ModelExtentions;

    const ROLE_USER = 1;
    const ROLE_MANAGER = 2;
    const ROLE_ADMIN = 3;

    const STATUS_OFF = 0;
    const STATUS_ACTIVE = 1;

    public $user_password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_email', 'user_name', 'user_status', 'user_status','user_role'], 'required'],
            [['user_email', 'user_name','user_surname','user_patronymic', 'user_phone','user_photo','user_auth_key','user_password'], 'string'],
            [['user_role', 'user_status', 'user_status','user_role'], 'integer'],
            [['user_email', 'user_name','user_patronymic','user_phone','user_password'], 'trim'],
        ];
    }


    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'user_email' => 'E-mail',
            'user_name' => 'Имя',
            'user_surname' => 'Фамилия',
            'user_patronymic' => 'Отчество',
            'user_phone' => 'Телефон',
            'user_photo' => 'Фото',
            'user_password' => 'Пароль',
            'user_status' => 'Статус',
            'user_role' => 'Роль',
        ];
    }


    public function afterFind() {
        parent::afterFind();
    }

    /**
     * @param $insert
     * @return bool
     */
    public function beforeSave($insert) {
        if ($this->user_password) {
            $this->user_password_hash = password_hash($this->user_password, PASSWORD_DEFAULT);
        }

        if (!$this->user_id) {
            $this->user_create_date = time();
        }

        if (parent::beforeSave($insert)) {
            return true;
        }

        return false;
    }

    /**
     * @param $insert
     * @param $changedAttributes
     * @return void
     */
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
    }


    public static function getRoles() {
        return [
            self::ROLE_USER => 'Пользователь',
            self::ROLE_MANAGER => 'Менеджер',
            self::ROLE_ADMIN => 'Админ',
        ];
    }
}