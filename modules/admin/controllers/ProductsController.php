<?php

namespace app\modules\admin\controllers;

use app\models\Product;
use app\modules\admin\models\Files;
use app\modules\admin\models\ProductFilter;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;
use app\modules\admin\models\Notices;

class ProductsController extends AdminController {

    /*
     * Страница списка товаров
     */
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


    /*
     * Редактирование товара
     */
    public function actionEdit($ID = false) {
        $model = is_numeric($ID) ? Product::findOne((int) $ID) : false;
        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $files = new Files();
        $files->setAttributes(['files' => $model->prod_images, 'dir' => 'products']);

        if (Yii::$app->request->post('Product')) {
            $model->load(Yii::$app->request->post());
            $files->load(Yii::$app->request->post());

            if ($model->validate() && $files->validate()) {
                $model->setAttributes(['prod_images' => $files->files]);
                $model->save() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при сохранении');

                return $this->redirect(['/admin/products']);
            }
        }

        return $this->render('edit', [
            'model' => $model,
            'files' => $files,
        ]);
    }


    /*
     * Добавление товара
     */
    public function actionAdd() {
        $model = new Product();
        $files = new Files();
        $files->setAttributes(['files' => $model->prod_images, 'dir' => 'products']);

        if (Yii::$app->request->post('Product')) {
            $model->load(Yii::$app->request->post());
            $files->load(Yii::$app->request->post());

            if ($model->validate() && $files->validate()) {
                $model->setAttributes(['prod_images' => $files->files]);
                $model->save() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при сохранении');

                return $this->redirect(['/admin/products']);
            }
        }

        return $this->render('add', [
            'model' => $model,
            'files' => $files,
        ]);
    }


    /*
     * Удаление товара
     */
    public function actionDelete($ID) {
        $model = is_numeric($ID) ? Product::findOne((int) $ID) : false;
        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $model->validate() && $model->delete() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при удалении');

        return $this->redirect(['/admin/products']);
    }
}