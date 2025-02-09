<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\Files;
use app\modules\admin\models\ModelExtentions;
use Yii;
use yii\db\ActiveRecord;

class Settings extends ActiveRecord {
    use ModelExtentions;

    const MAIL_SEND_TYPE_PHP = 1;
    const MAIL_SEND_TYPE_SWIFT = 2;

    const MAIL_ENCRYPT_TYPE_SSL = 1;
    const MAIL_ENCRYPT_TYPE_TLS = 2;
    const MAIL_ENCRYPT_TYPE_NONE = 3;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['admin_email','mail_user_name','mail_user_pass','mail_port','mail_port',], 'safe'],
            [['site_name','currency','site_name','cookie_name','site_name','site_name','site_name','site_name',
                'page_count_entries','upload_max_size','mail_send_type','mail_encrypt_type'], 'required'
            ],
            [['site_name','currency','admin_email','cookie_name','mail_user_name','mail_user_pass'], 'string'],
            [['page_count_entries','upload_max_size','mail_send_type','mail_host','mail_port','mail_encrypt_type'], 'integer'],
            [['site_name'], 'trim'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'site_name' => 'Название сайта',
            'currency' => 'Валюта',
            'admin_email' => 'E-mail админа (для уведомлений)',
            'page_count_entries' => 'Количество записей на странице',
            'cookie_name' => 'Имя куки',
            'upload_max_size' => 'Макс. размер файла при отправке',
            'mail_send_type' => 'Тип отправки',
            'mail_host' => 'SMTP хост',
            'mail_port' => 'SMTP порт',
            'mail_user_name' => 'Пользователь',
            'mail_user_pass' => 'Пароль',
            'mail_encrypt_type' => 'Шифрование',
        ];
    }


    public function beforeSave($insert) {
        $result = parent::beforeSave($insert);
        return $result;
    }

    public static function getMailSendTypes() {
        $types = [
            self::MAIL_SEND_TYPE_PHP => 'PHP Mail',
            self::MAIL_SEND_TYPE_SWIFT => 'Swift Mail',
        ];

        return $types;
    }

    public static function getMailEncryptTypes() {
        $types = [
            self::MAIL_ENCRYPT_TYPE_SSL => 'SSL',
            self::MAIL_ENCRYPT_TYPE_TLS => 'TLS',
            self::MAIL_ENCRYPT_TYPE_NONE => 'Нет'
        ];

        return $types;
    }

}