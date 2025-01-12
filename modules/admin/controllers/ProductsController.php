<?php

namespace app\modules\admin\controllers;

use app\models\Products;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\data\Pagination;
use Yii;
use yii\web\HttpException;

class ProductsController extends AdminController {

    public function actionIndex() {
        $pageSize = 36;

        $query = Products::find()->where(['prod_status' => [Products::STATUS_ACTIVE]]);
        $pages = new Pagination([
            'pageSize' => $pageSize,
            'defaultPageSize' => $pageSize,
            'totalCount' => $query->count()
        ]);

        $query
            ->orderBy(['prod_id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit);

        return $this->render('index', [
            'products' => $query->all(),
        ]);
    }


    /**
     * @param $ID
     * @return string
     * @throws HttpException
     * @throws \yii\db\Exception
     */
    public function actionEdit($ID = false) {
        $model = is_numeric($ID) ? Products::findOne((int) $ID) : false;
        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        if ($post = Yii::$app->request->post('Products')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/products']);
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }


    public function actionAdd() {
        $model = new Products();

        if ($post = Yii::$app->request->post('Products')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/products']);
        }

        return $this->render('add', [
            'model' => $model,
        ]);
    }
}