<?php

namespace app\controllers;

use app\models\Categories;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;

class CategoriesController extends Controller {

    public function actionIndex() {
        $page_size = 36;

        $query = Categories::find()->where([
            'cat_status' => [Categories::STATUS_ACTIVE],
            'cat_parent' => 0,
        ]);

        $pages = new Pagination([
            'pageSize' => $page_size,
            'defaultPageSize' => $page_size,
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
        $page_size = 36;

        $category = Categories::find()->where(['cat_alias' => $alias])->one();
        if (!$category) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $query = Categories::find()->where([
            'cat_status' => [Categories::STATUS_ACTIVE],
            'cat_parent' => $category->cat_id,
        ]);

        $count_subcategories = $query->count();
        if ($count_subcategories) {
            $pages = new Pagination([
                'pageSize' => $page_size,
                'defaultPageSize' => $page_size,
                'totalCount' => $count_subcategories
            ]);

            $query
                ->orderBy(['cat_id' => SORT_DESC])
                ->offset($pages->offset)
                ->limit($pages->limit);

            return $this->render('categories', [
                'category' => $category,
                'categories' => $query->all(),
            ]);
        }

        return $this->render('category', [
            'category' => $category,
        ]);
    }
}
