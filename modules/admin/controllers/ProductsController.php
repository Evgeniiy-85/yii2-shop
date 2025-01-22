<?php

namespace app\modules\admin\controllers;

use app\models\Product;
use app\modules\admin\models\Files;
use app\modules\admin\models\ProductFilter;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;
use yii\web\UploadedFile;

class ProductsController extends AdminController {

    public function actionIndex() {
        $page_size = 36;

        $query = Product::find();
        $pages = new Pagination([
            'pageSize' => $page_size,
            'defaultPageSize' => $page_size,
            'totalCount' => $query->count()
        ]);

        $filter = new ProductFilter();
        $filter->add($query);

        $query
            ->orderBy(['prod_id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->joinWith('categories');

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
        $model = is_numeric($ID) ? Product::findOne((int) $ID) : false;
        $files = new Files();

        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        if ($post = Yii::$app->request->post('Product')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/products']);
        }

        return $this->render('edit', [
            'model' => $model,
            'files' => $files,
        ]);
    }


    public function actionAdd() {
        $model = new Product();
        $files = new Files();

        if ($post = Yii::$app->request->post('Product')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/products']);
        }

        return $this->render('add', [
            'model' => $model,
            'files' => $files,
        ]);
    }
}