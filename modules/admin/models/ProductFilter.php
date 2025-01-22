<?php
namespace app\modules\admin\models;

use app\components\Helpers;
use app\models\Product;
use Yii;

class ProductFilter extends Product {
    public $is_filter;
    private $filter_name = 'ProductFilter';


    public function rules() {
        return [
            [['prod_title', 'prod_status','prod_category','prod_article'], 'safe'],
            [['prod_title', 'prod_article',], 'trim'],
        ];
    }


    /**
     * @return void
     */
    public function init() {
        if ($this->load(Yii::$app->request->post())) {
            Yii::$app->session->set($this->filter_name, Yii::$app->request->post());
        } elseif (Yii::$app->request->get('reset_filter')) {
            Yii::$app->session->remove($this->filter_name);
        }

        $this->load(Yii::$app->session->get($this->filter_name));
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
        return 'products';
    }

    public function add(&$query) {
        if ($this->prod_title && $this->is_filter = 1) {
            $query->andWhere(['like', 'prod_title', $this->prod_title]);
        }

        if ($this->prod_status != '' && $this->is_filter = 1) {
            $query->andWhere(['prod_status' => $this->prod_status]);
        }

        if ($this->prod_category != '' && $this->is_filter = 1) {
            $query->andWhere(['prod_category' => $this->prod_category]);
        }

        if ($this->prod_article != '' && $this->is_filter = 1) {
            $query->andWhere(['prod_article' => $this->prod_article]);
        }
    }
}