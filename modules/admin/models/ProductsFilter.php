<?php
namespace app\modules\admin\models;

use app\components\Helpers;
use app\models\Products;
use Yii;

class ProductsFilter extends Products {

    public $full_name;

    public function rules() {
        return [
            [['prod_title', 'prod_status',], 'safe'],
            [['prod_title',], 'trim'],
        ];
    }


    /**
     * @return void
     */
    public function init() {
        $key = 'ProductsFilter';
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
        return 'products';
    }

    public function add(&$query) {
        if ($this->prod_title) {
            $query->andWhere(['like', 'prod_title', $this->prod_title]);
        }

        if ($this->prod_status != '') {
            $query->andWhere(['prod_status' => $this->prod_status]);
        }
    }
}