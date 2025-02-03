<?php
namespace app\models;

use app\components\Helpers;
use app\models\Product;
use Yii;
use yii\base\Model;

class ProductFilter extends Product {
    public $min_price;
    public $max_price;
    public $prod_category;
    public $is_filter;
    private $filter_name = 'ProductFilter';


    public function rules() {
        return [
            [['min_price', 'max_price', 'prod_category'], 'safe'],
            [['min_price', 'max_price', 'prod_category'], 'integer'],
        ];
    }


    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'min_price' => 'от '.Product::find()->where(['prod_status' => Product::STATUS_ACTIVE, 'prod_category' => $this->prod_category])->min('prod_price'),
            'max_price' => 'до '.Product::find()->where(['prod_status' => Product::STATUS_ACTIVE, 'prod_category' => $this->prod_category])->max('prod_price'),
        ];
    }

    public function init() {
        parent::init();
        if (Yii::$app->request->get('filter') && Yii::$app->request->get('filter') != 'reset') {
            $this->load(Yii::$app->request->get());
        }
    }

    /**
     * @param $data
     * @param $formName
     * @return bool
     */
    public function load($data, $formName = null) {
        if (!isset($data['filter']) || $data['filter'] == 'reset') {
            return false;
        }

        return parent::load($data, $formName);
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'products';
    }

    public function add(&$query) {
        if ($this->min_price && $this->is_filter = 1) {
            $query->andWhere(['>=', 'prod_price', $this->min_price]);
        }

        if ($this->max_price && $this->is_filter = 1) {
            $query->andWhere(['<=', 'prod_price', $this->max_price]);
        }
    }
}