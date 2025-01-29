<?php
namespace app\modules\admin\models;

use app\components\Helpers;
use app\models\Category;
use Yii;

class CategoryFilter extends Category {
    use AdminFilter;

    public $is_filter;
    private $filter_name = 'CategoryFilter';

    public function rules() {
        return [
            [['cat_title', 'cat_status',], 'safe'],
            [['cat_parent',], 'integer'],
            [['cat_title',], 'trim'],
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
        return parent::attributeLabels();
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'categories';
    }

    public function add(&$query) {
        if ($this->cat_title && $this->is_filter = 1) {
            $query->andWhere(['like', 'cat_title', $this->cat_title]);
        }

        if ($this->cat_status != '' && $this->is_filter = 1) {
            $query->andWhere(['cat_status' => $this->cat_status]);
        }

        if ($this->cat_parent != '' && $this->is_filter = 1) {
            $query->andWhere(['cat_parent' => $this->cat_parent]);
        }
    }
}