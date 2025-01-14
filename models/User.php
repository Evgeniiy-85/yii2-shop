<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface {
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    private $user;

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        return $id ? Users::findOne(['user_id' => $id, 'user_status' => Users::STATUS_ACTIVE]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }

    /**
     * @param $username
     * @return Users|null
     */
    public static function findByUsername($username) {
        return Users::findOne(['user_name' => $username, 'user_status' => Users::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        $model = new Users;
        return $model->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }
}
