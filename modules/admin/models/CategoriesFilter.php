<?php
namespace app\modules\admin\models;

use app\components\Helpers;
use app\models\Categories;
use Yii;

class CategoriesFilter extends Categories {
    public $is_filter;

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
        $key = 'CategoriesFilter';
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