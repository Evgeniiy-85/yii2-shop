<?php
namespace app\modules\admin\models;

use app\components\Helpers;
use app\models\Payment;
use Yii;

class PaymentFilter extends Payment {
    use AdminFilter;

    public $is_filter;
    private $filter_name = 'PaymentFilter';


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