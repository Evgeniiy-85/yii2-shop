<?php

namespace app\modules\admin\controllers;

use app\models\Categories;
use app\modules\admin\models\Files;
use app\modules\admin\models\CategoriesFilter;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;
class CategoriesController extends AdminController {

    public function actionIndex() {
        $page_size = 36;

        $query = Categories::find();
        $pages = new Pagination([
            'pageSize' => $page_size,
            'defaultPageSize' => $page_size,
            'totalCount' => $query->count()
        ]);

        $filter = new CategoriesFilter();
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


    /**
     * @param $ID
     * @return string
     * @throws HttpException
     * @throws \yii\db\Exception
     */
    public function actionEdit($ID = false) {
        $model = is_numeric($ID) ? Categories::findOne((int) $ID) : false;
        $files = new Files();

        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        if (Yii::$app->request->post('Categories')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/categories']);
        }

        return $this->render('edit', [
            'model' => $model,
            'files' => $files,
        ]);
    }


    public function actionAdd() {
        $model = new Categories();
        $files = new Files();

        if ($post = Yii::$app->request->post('Categories')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/categories']);
        }

        return $this->render('add', [
            'model' => $model,
            'files' => $files,
        ]);
    }
}