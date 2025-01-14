<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\ModelExtentions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;
use yii\helpers\ArrayHelper;
class Users extends ActiveRecord implements IdentityInterface {
    use ModelExtentions;

    const ROLE_USER = 1;
    const ROLE_MANAGER = 2;
    const ROLE_ADMIN = 3;

    const STATUS_OFF = 0;
    const STATUS_ACTIVE = 1;

    public $user_password;
    private $user_id;

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
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%users}}';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    public function init(){
        // $this->on($this::EVENT_AFTER_LOGIN, [$this, 'afterLogin']);
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
     * @return true|\yii\rbac\Assignment
     * @throws \Exception
     */
    public function saveRole() {
        $role = null;

        switch ($this->user_role) {
            case self::ROLE_MANAGER:
                $role = Yii::$app->authManager->getRole('manager');
                if (!$role) {
                    $role = Yii::$app->authManager->createRole('manager');
                    $role->description = 'Менеджер';
                    Yii::$app->authManager->add($role);
                }
                break;
            case self::ROLE_ADMIN:
                $role = Yii::$app->authManager->getRole('admin');
                if (!$role) {
                    $role = Yii::$app->authManager->createRole('admin');
                    $role->description = 'Администратор';
                    Yii::$app->authManager->add($role);
                }
                break;
        }

        Yii::$app->authManager->revokeAll($this->user_id);
        if ($role) {
            return Yii::$app->authManager->assign($role, $this->user_id);
        }

        return true;
    }


    public function setRole($name)
    {
        $auth = Yii::$app->authManager;

        if (!empty($name)) {
            $userRoles = array_keys($auth->getRolesByUser($this->id));
            if (!isset($userRoles[0]) || $userRoles[0] != $name) {
                $role = $auth->getRole($name);
                $event = $this->getIsNewRecord() ? self::EVENT_AFTER_INSERT : self::EVENT_AFTER_UPDATE;

                $this->on($event, function () use ($auth, $role) {
                    $auth->revokeAll($this->id);
                    $auth->assign($role, $this->id);
                });
            }
        } elseif ($this->getIsNewRecord() === false) {
            $auth->revokeAll($this->id);
        }
    }

    public function getRole()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser($this->id);
        return !empty($roles) ? array_keys($roles)[0] : null;
    }

    public static function getRoleList()
    {
        $data = Yii::$app->authManager->getRoles();
        $roles = ArrayHelper::getColumn($data, 'description');
        return $roles;
    }


    /**
     * @param $email
     * @return Users|null
     */
    public static function findByEmail($email) {
        return static::findOne(['user_email' => $email, 'user_status' => self::STATUS_ACTIVE]);
    }


    public static function getRoles() {
        return [
            self::ROLE_USER => 'Пользователь',
            self::ROLE_MANAGER => 'Менеджер',
            self::ROLE_ADMIN => 'Админ',
        ];
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
        return self::findOne(['auth_key' => $token, 'user_status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->user_id;
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
}