<?php
namespace app\modules\admin\models;

use app\components\Helpers;
use app\models\Product;
use app\modules\admin\models\AdminFilter;
use Yii;

class ProductFilter extends Product {
    use AdminFilter;

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