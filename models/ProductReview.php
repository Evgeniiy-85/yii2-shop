<?php
namespace app\models;

use app\components\Helpers;
use app\models\Product;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\User;

class ProductReview extends ActiveRecord {
    const STATUS_ACTIVE = 1;

    public function rules() {
        return [
            [['prod_id', 'user_id'], 'required'],
            [['prod_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'products_reviews';
    }

    public function getUsers() {
        return $this->hasOne(User::class, ['user_id' => 'user_id']);
    }
}