<?php

namespace app\modules\admin\controllers;

use app\models\Payment;
use app\models\Product;
use app\modules\admin\models\Files;
use app\modules\admin\models\ProductFilter;
use app\models\Settings;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use app\modules\admin\models\Notices;

/**
 * Default controller for the `admin` module
 */
class SettingsController extends AdminController {

    public function actionIndex() {
        $settings = Settings::findOne(1);
        if (!$settings) {
            $settings = new Settings();
        }

        $files = new Files();

        if (Yii::$app->request->post('Settings')) {
            $settings->load(Yii::$app->request->post());
            $settings->validate() && $settings->save() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при сохранении');

            return $this->redirect(['/admin']);
        }

        return $this->render('index', [
            'settings' => $settings,
            'files' => $files,
        ]);
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
