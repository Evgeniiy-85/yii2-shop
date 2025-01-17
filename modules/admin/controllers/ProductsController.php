<?php

namespace app\modules\admin\controllers;

use app\models\Products;
use app\modules\admin\models\Files;
use app\modules\admin\models\ProductsFilter;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;
use yii\web\UploadedFile;

class ProductsController extends AdminController {

    public function actionIndex() {
        $pageSize = 36;

        $query = Products::find()->where(['prod_status' => [Products::STATUS_ACTIVE]]);
        $pages = new Pagination([
            'pageSize' => $pageSize,
            'defaultPageSize' => $pageSize,
            'totalCount' => $query->count()
        ]);

        $filter = new ProductsFilter();
        $filter->add($query);

        $query
            ->orderBy(['prod_id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit);

        return $this->render('index', [
            'products' => $query->all(),
            'filter' => $filter,
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
        $files = new Files();

        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        if ($post = Yii::$app->request->post('Products')) {
            $model->load(Yii::$app->request->post());
            //$model->prod_image = $files->upload('products');
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/products']);
        }

        return $this->render('edit', [
            'model' => $model,
            'files' => $files,
        ]);
    }


    public function actionAdd() {
        $model = new Products();
        $files = new Files();

        if ($post = Yii::$app->request->post('Products')) {
            $model->load(Yii::$app->request->post());
           // $model->prod_image = $files->upload('products');
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/products']);
        }

        return $this->render('add', [
            'model' => $model,
            'files' => $files,
        ]);
    }
}