<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\Files;
use app\modules\admin\models\ModelExtentions;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Favorites extends Model {
    public $products = [];
    private $save_key = 'favorites';

    public function rules() {
        return [
            [['products'], 'safe'],
        ];
    }


    /**
     * @return void
     */
    public function loadModel() {
        $this->setAttributes(Yii::$app->session->get($this->save_key, []));
    }

    /**
     * @return array|mixed
     */
    public function getProducts() {
        $this->loadModel();
        return $this->products;
    }

     /**
     * @param int $prod_id
     * @return true
     */
    public function addProduct(int $prod_id) {
        $this->loadModel();
        $this->products[$prod_id] = true;

        Yii::$app->session->set($this->save_key, $this->attributes);

        return true;
    }


    /**
     * @param $prod_id
     * @return true
     */
    public function removeProduct($prod_id) {
        $this->loadModel();
        if ($this->products && isset($this->products[$prod_id])) {
            unset($this->products[$prod_id]);
        }

        Yii::$app->session->set($this->save_key, $this->attributes);

        return true;
    }
}