<?php

namespace app\modules\admin\controllers;

use app\models\Product;
use app\modules\admin\models\Files;
use app\modules\admin\models\ProductFilter;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\HttpException;
use app\modules\admin\models\Notices;

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
        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $files = new Files();
        $files->setAttributes(['files' => $model->prod_images]);
        $files->setAttributes(['dir' => 'products']);

        if ($files->load(Yii::$app->request->post())) {
            $model->setAttributes(['prod_images' => $files->files]);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->save() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при сохранении');
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

        if ($files->load(Yii::$app->request->post())) {
            $model->setAttributes(['prod_images' => $files->files]);
        }

        if ($post = Yii::$app->request->post('Product')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/products']);
        }

        return $this->render('add', [
            'model' => $model,
            'files' => $files,
        ]);
    }
}