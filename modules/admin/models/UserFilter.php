<?php
namespace app\modules\admin\models;

use app\components\Helpers;
use \app\models\User;
use Yii;
use \app\modules\admin\models\AdminFilter;

class UserFilter extends User {
    use AdminFilter;

    public $full_name;
    public $is_filter;
    private $filter_name = 'UserFilter';

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
        parent::init();
        $this->filterInit();
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
        if ($this->user_email && $this->is_filter = 1) {
            $query->andWhere(['like', 'users.user_email', $this->user_email]);
        }

        if ($this->full_name && $this->is_filter = 1) {
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

        if ($this->user_role && $this->is_filter = 1) {
            $query
                ->leftJoin('auth_assignment', 'auth_assignment.user_id = users.user_id')
                ->andWhere(['auth_assignment.item_name' => $this->user_role]);
        }

        if ($this->user_status != '' && $this->is_filter = 1) {
            $query->andWhere(['user_status' => $this->user_status]);
        }
    }
}