<?php
namespace app\modules\admin\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model {

    public $email;
    public $password;
    public $password_hash;

    public function rules() {
        return [
            [['email', 'password'], 'trim'],
            [['email', 'password'], 'required','message' => 'Это поле обязательно для заполнения'],
            [['password'], 'string', 'min' => 6],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'E-mail',
            'password' => 'Пароль',
        ];
    }

    public static function login() {
        $session = Yii::$app->session;
        $session->open();
        $session->set('auth_site_admin', true);
    }

    public static function logout() {
        $session = Yii::$app->session;
        $session->open();
        if ($session->has('auth_site_admin')) {
            $session->remove('auth_site_admin');
        }
    }


    /**
     * @return void
     */
    public function afterValidate() {
        parent::afterValidate();
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
    }
}