<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $password_hash;
    public $_user;
    public $rememberMe;

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
     * @return mixed
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
