<?php
namespace app\modules\admin\models;

use app\models\User;
use Yii;
use yii\base\Model;

class LoginForm extends Model {

    public $email;
    public $password;
    public $username;
    public $password_hash;
    public $_user;
    public $rememberMe;

    public function rules() {
        return [
            [['email', 'password'], 'trim'],
            [['email', 'password'], 'required','message' => 'Это поле обязательно для заполнения'],
            [['password'], 'string', 'min' => 6],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'E-mail',
            'password' => 'Пароль',
        ];
    }


    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверные логин или пароль');
            }
        }
    }


    /**
     * @return bool
     */
    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }

        return false;
    }


    /**
     * @param $token
     * @return bool
     */
    public function loginByToken($token) {
        $user = User::findIdentityByAccessToken($token);
        if (empty($user)) {
            return false;
        }

        Yii::$app->user->logout();

        return Yii::$app->user->login($user, 3600 * 24 * 30);
    }

    /**
     * @return Users|null
     */
    protected function getUser() {
        if (!isset($this->_user)) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }


    /**
     * @return void
     */
    public function afterValidate() {
        parent::afterValidate();
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
    }
}