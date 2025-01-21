<?php
namespace app\modules\admin\models;

use app\components\Helpers;
use app\models\Payments;
use Yii;

class PaymentsFilter extends Payments {
    public $is_filter;
    private $filter_name = 'PaymentsFilter';


    public function rules() {
        return [
            [['pay_title', 'pay_status',], 'safe'],
            [['pay_title', 'pay_status',], 'trim'],
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
        return 'payments';
    }

    public function add(&$query) {
        if ($this->pay_title && $this->is_filter = 1) {
            $query->andWhere(['like', 'pay_title', $this->pay_title]);
        }

        if ($this->pay_status != '' && $this->is_filter = 1) {
            $query->andWhere(['pay_status' => $this->pay_status]);
        }
    }
}