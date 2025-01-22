<?php

namespace app\modules\admin\controllers;

use app\models\Payment;
use app\models\Product;
use app\modules\admin\models\ProductFilter;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin` module
 */
class SettingsController extends AdminController {

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
        return $this->render('index');
    }

    public function actionMain() {
        return $this->render('main');
    }

    public function actionAppearance() {
        return $this->render('appearance');
    }

    public function actionPayments() {
        $page_size = 36;

        $query = Payment::find();
        $filter = new ProductFilter();
        $filter->add($query);

        $query
            ->orderBy(['pay_id' => SORT_DESC]);

        return $this->render('payments/index', [
            'payments' => $query->all(),
        ]);

        return $this->render('payments/index');
    }

    public function actionPayment($ID) {

    }
}
