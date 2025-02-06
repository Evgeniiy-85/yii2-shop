<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use app\modules\admin\models\Files;
use app\modules\admin\models\CategoryFilter;
use app\modules\admin\models\Notices;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;
class CategoriesController extends AdminController {

    /*
     * Страница списка категорий
     */
    public function actionIndex() {
        $page_size = 36;

        $query = Category::find();
        $pages = new Pagination([
            'pageSize' => $page_size,
            'defaultPageSize' => $page_size,
            'totalCount' => $query->count()
        ]);

        $filter = new CategoryFilter();
        $filter->add($query);

        $query
            ->orderBy(['cat_id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit);

        return $this->render('index', [
            'categories' => $query->all(),
            'filter' => $filter,
        ]);
    }


    /*
     * Редактирование категории
     */
    public function actionEdit($ID = false) {
        $model = is_numeric($ID) ? Category::findOne((int) $ID) : false;
        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $files = new Files();
        $files->setAttributes(['file' => $model->cat_image, 'dir' => 'categories']);

        if (Yii::$app->request->post('Category')) {
            $model->load(Yii::$app->request->post());
            if ($image = $files->uploadImage()) {
                $model->setAttribute('cat_image', $image);
            }
            $model->validate() && $model->save() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при сохранении');

            return $this->redirect(['/admin/categories']);
        }

        return $this->render('edit', [
            'model' => $model,
            'files' => $files,
        ]);
    }


    /*
     * Добавление категории
     */
    public function actionAdd() {
        $model = new Category();
        $files = new Files();
        $files->setAttributes(['file' => $model->cat_image, 'dir' => 'categories']);

        if (Yii::$app->request->post('Category')) {
            $model->load(Yii::$app->request->post());
            if ($image = $files->uploadImage()) {
                $model->setAttribute('cat_image', $image);
            }
            $model->validate() && $model->save() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при сохранении');

            return $this->redirect(['/admin/categories']);
        }

        return $this->render('add', [
            'model' => $model,
            'files' => $files,
        ]);
    }

    /*
     * Удаление категории
     */
    public function actionDelete($ID) {
        $model = is_numeric($ID) ? Category::findOne((int) $ID) : false;
        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $model->validate() && $model->delete() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при удалении');

        return $this->redirect(['/admin/categories']);
    }
}