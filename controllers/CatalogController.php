<?php

namespace app\controllers;

use app\models\Category;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;

class CatalogController extends Controller {
    public function actionIndex() {
        $count_categories = Category::find()->where([
            'cat_status' => [Category::STATUS_ACTIVE],
            'cat_parent' => 0,
        ])->count();

        if ($count_categories) {
            $category_exists = Category::find()->where([
                'cat_status' => [Category::STATUS_ACTIVE],
                'cat_parent' => 0,
            ])->count();

            if ($category_exists) {
                $category = Category::find()->where([
                    'cat_status' => [Category::STATUS_ACTIVE],
                    'cat_parent' => 0,
                ])->one();
                $sub_categories = Category::find()->where([
                    'cat_status' => [Category::STATUS_ACTIVE],
                    'cat_parent' => 0,
                ])->all();
            }
        }

exit;

        $page_size = 36;






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
}
