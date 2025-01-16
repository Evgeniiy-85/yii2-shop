<?php
namespace app\modules\admin\models;

use app\components\Helpers;
use \app\models\Users;
use Yii;

class UsersFilter extends Users {

    public $full_name;

    public function rules() {
        return [
            [['user_email', 'full_name', 'user_role', 'user_status',], 'safe'],
            [['user_email', 'full_name',], 'trim'],
        ];
    }


    /**
     * @return void
     */
    public function init() {
        $key = 'UsersFilter';
        if (Yii::$app->request->get('reset_filter')) {
            Yii::$app->session->remove($key);
        } else {
            if (Yii::$app->request->post()) {
                Yii::$app->session->set($key, Yii::$app->request->post());
                $this->load(Yii::$app->request->post());
            }  else {
                $this->load(Yii::$app->session->get($key));
            }
        }
    }


    /**
     * @return string[]
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'full_name' => 'Имя/фамилия',
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users';
    }

    public function add(&$query) {
        if ($this->user_email) {
            $query->andWhere(['like', 'users.user_email', $this->user_email]);
        }

        if ($this->full_name) {
            $data = explode(' ', $this->full_name);
            if (count($data) > 1) {
                $query->andWhere(['OR',
                    ['in', 'user_name', $data],
                    ['in', 'user_surname', $data],
                ]);
            } else {
                $query->andWhere(['OR',
                    ['user_name' => $this->full_name],
                    ['user_surname' => $this->full_name],
                ]);
            }

        }

        if ($this->user_role) {
            $query
                ->leftJoin('auth_assignment', 'auth_assignment.user_id = users.user_id')
                ->andWhere(['auth_assignment.item_name' => $this->user_role]);
        }

        if ($this->user_status != '') {
            $query->andWhere(['user_status' => $this->user_status]);
        }
    }
}