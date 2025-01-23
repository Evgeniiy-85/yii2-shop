<?php
namespace app\models;

use app\components\Helpers;
use app\models\Product;
use Yii;

class ProductFilter extends Product {
    public $min_price;
    public $max_price;
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
        $this->min_price = Product::find()->where(['prod_status' => [Product::STATUS_ACTIVE]])->min('prod_price');
        $this->max_price = Product::find()->where(['prod_status' => [Product::STATUS_ACTIVE]])->max('prod_price');

        $this->load(Yii::$app->request->get());
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'products';
    }

    public function add(&$query) {
        if ($this->min_price) {
            $query->andWhere(['prod_price' => $this->min_price]);
        }

        if ($this->max_price) {
            $query->andWhere(['prod_price' => $this->max_price]);
        }
    }
}