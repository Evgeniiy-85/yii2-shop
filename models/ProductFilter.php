<?php
namespace app\models;

use app\components\Helpers;
use app\models\Product;
use Yii;

class ProductFilter extends Product {
    public $min_price;
    public $max_price;
    public $is_filter;
    private $filter_name = 'ProductFilter';


    public function rules() {
        return [
            [['min_price', 'max_price',], 'safe'],
            [['min_price', 'max_price',], 'integer'],
        ];
    }


    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'min_price' => '',
            'max_price' => '',
        ];
    }

    /**
     * @return void
     */
    public function init() {
        if (!Yii::$app->request->get('reset_filter')) {
            $this->load(Yii::$app->request->get());
        }
        if (!$this->min_price) {
            $this->min_price = Product::find()->where(['prod_status' => [Product::STATUS_ACTIVE]])->min('prod_price');
        }

        if (!$this->max_price) {
            $this->max_price = Product::find()->where(['prod_status' => [Product::STATUS_ACTIVE]])->max('prod_price');
        }
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'products';
    }

    public function add(&$query) {
        if ($this->min_price && $this->is_filter = 1) {
            $query->andWhere(['prod_price' => $this->min_price]);
        }

        if ($this->max_price && $this->is_filter = 1) {
            $query->andWhere(['prod_price' => $this->max_price]);
        }
    }
}