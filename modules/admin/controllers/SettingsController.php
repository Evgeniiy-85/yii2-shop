<?php

namespace app\modules\admin\controllers;

use app\models\Payment;
use app\modules\admin\models\Files;
use app\modules\admin\models\PaymentFilter;
use app\models\Settings;
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
            if ($image = $files->uploadLogo()) {
                $settings->setAttribute('logo', $image);
            }
            if ($image = $files->uploadFavicon()) {
                $settings->setAttribute('favicon', $image);
            }
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
        $filter = new PaymentFilter();
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
