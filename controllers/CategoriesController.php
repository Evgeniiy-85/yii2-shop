<?php

namespace app\controllers;

use app\models\Categories;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;

class CategoriesController extends Controller {

    public function actionIndex() {
        $pageSize = 36;

        $query = Categories::find()->where(['cat_status' => [Categories::STATUS_ACTIVE]]);
        $pages = new Pagination([
            'pageSize' => $pageSize,
            'defaultPageSize' => $pageSize,
            'totalCount' => $query->count()
        ]);

        $query
            ->orderBy(['cat_id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit);

        return $this->render('categories', [
            'categories' => $query->all(),
        ]);
    }


    public function actionCategory($alias) {
        $category = Categories::find()->where(['cat_alias' => $alias])->one();
        if (!$category) {
            throw new HttpException(404, "Страница не найдена.");
        }

        return $this->render('category', [
            'category' => $category,
        ]);
    }
}
