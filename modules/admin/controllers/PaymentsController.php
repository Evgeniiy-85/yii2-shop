<?php

namespace app\modules\admin\controllers;

use app\models\Payment;
use app\modules\admin\models\Files;
use app\modules\admin\models\PaymentFilter;

/**
 * Default controller for the `admin` module
 */
class PaymentsController extends SettingsController {

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action) {
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result){
        return parent::afterAction($action, $result);
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $query = Payments::find();

        $filter = new PaymentFilter();
        $filter->add($query);

        $query
            ->orderBy(['pay_id' => SORT_DESC]);

        return $this->render('/settings/payments/index', [
            'payments' => $query->all(),
            'filter' => $filter,
        ]);
    }
}
