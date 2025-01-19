<?php

namespace app\models;

use app\modules\admin\models\ModelExtentions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;


/**
 * User model
 * @property integer $user_id
 * @property integer $user_status
 * @property integer $user_create_date
 * @property integer $user_last_visit_date
 * @property string $user_email
 * @property string $user_surname
 * @property string $user_patronymic
 * @property string $user_phone
 * @property string $user_photo
 * @property string $user_name
 * @property integer $created_at
 * @property string $user_auth_key
 * @property string $user_password_hash
 */
class Users extends ActiveRecord implements IdentityInterface {
    use ModelExtentions;

    const STATUS_OFF = 0;
    const STATUS_ACTIVE = 1;

    public $user_password;
    public $updated_at;
    public $user_role;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_email', 'user_name', 'user_status', 'user_status','user_role'], 'required'],
            [['user_email', 'user_name','user_surname','user_patronymic', 'user_phone','user_photo','user_auth_key','user_password','user_role'], 'string'],
            [['user_status', 'user_status'], 'integer'],
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

    /**
     * @return void
     */
    public function afterFind() {
        parent::afterFind();
        $this->user_role = $this->getUserRoleName();
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
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @param $insert
     * @param $changedAttributes
     * @return void
     * @throws \Exception
     */
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        $this->saveRole();
    }


    /**
     * @param $role_name
     * @param $user_id
     * @return false|\yii\rbac\Assignment
     * @throws \Exception
     */
    public static function setNewRole($role_name, $user_id) {
        $auth = Yii::$app->authManager;
        $auth->revokeAll($user_id);
        $role = $auth->getRole($role_name);

        return $role ? $auth->assign($role, $user_id) : false;
    }


    /**
     * @return bool|\yii\rbac\Assignment
     * @throws \Exception
     */
    public function saveRole() {
        $role_name = $this->getUserRoleName();
        if ($role_name !== $this->user_role) {
            return self::setNewRole($this->user_role, $this->user_id);
        }

        return true;
    }

    /**
     * @return false|mixed|null
     */
    public function getUserRole() {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser($this->user_id);

        return $roles ? array_shift($roles) : false;
    }

    /**
     * @return string
     */
    public function getUserRoleName() {
        $role = $this->getUserRole();
        return $role ? $role->name : '';
    }

    /**
     * @return array
     */
    public function getRoles() {
        $roles = [];
        if ($_roles = Yii::$app->authManager->getRoles()) {
            foreach ($_roles as $role) {
                $roles[$role->name] = $role->description;
            }
        }

        return $roles;
    }

    /**
     * @param $status
     * @return int|int[]
     */
    public static function getStatuses($status = false) {
        $statuses = [
              self::STATUS_ACTIVE => 'Активен',
              self::STATUS_OFF => 'Отключен',
        ];

        return $status !== false ? $statuses[$status] : $statuses;
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->primaryKey;
    }

    /**
     * @param $email
     * @return Users|null
     */
    public static function findByEmail($email) {
        return static::findOne(['user_email' => $email, 'user_status' => self::STATUS_ACTIVE]);
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
    public static function findIdentity($id) {
        return self::findOne(['user_id' => $id, 'user_status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return self::findOne(['user_auth_key' => $token, 'user_status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->user_auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param $password
     * @return bool
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->user_password_hash);
    }
}