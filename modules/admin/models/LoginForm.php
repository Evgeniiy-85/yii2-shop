<?php
namespace app\modules\admin\models;

use app\models\Users;
use common\models\User;
use Yii;
use yii\base\Model;

class LoginForm extends Model {

    public $email;
    public $password;
    public $password_hash;
    public $_user;
    public $remember_me;

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
            $user = $this->getUser();
            if ($user && $user['user_role'] == Users::ROLE_ADMIN) {
                $session = Yii::$app->session;
                $session->open();
                $session->set('auth_site_admin', true);
                
                return Yii::$app->user->login($user, $this->remember_me ? 3600*24*30 : 0);
            }
        }

        return false;
    }

    public static function logout() {
        $session = Yii::$app->session;
        $session->open();
        if ($session->has('auth_site_admin')) {
            $session->remove('auth_site_admin');
        }
    }


    /**
     * @return Users|null
     */
    protected function getUser() {
        if (!isset($this->_user)) {
            $this->_user = Users::findByEmail($this->email);
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