<?php

namespace app\modules\admin\controllers;

use app\models\Payments;
use app\models\Products;
use app\modules\admin\models\Files;
use app\modules\admin\models\PaymentsFilter;
use app\modules\admin\models\ProductsFilter;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use yii\web\HttpException;

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
        $filter = new ProductsFilter();
        $filter->add($query);

        $filter = new PaymentsFilter();
        $filter->add($query);

        $query
            ->orderBy(['pay_id' => SORT_DESC]);

        return $this->render('/settings/payments/index', [
            'payments' => $query->all(),
            'filter' => $filter,
        ]);
    }

    public function actionEdit($ID) {
        $model = is_numeric($ID) ? Payments::findOne((int) $ID) : false;
        $files = new Files();

        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        if ($post = Yii::$app->request->post('Payments')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/settings/payments']);
        }

        return $this->render('/settings/payments/edit', [
            'model' => $model,
            'files' => $files,
        ]);
    }
}
