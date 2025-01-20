<?php

namespace app\controllers;

use app\models\Categories;
use app\models\Products;
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

        return $this->render('index', [
            'categories' => $query->all(),
        ]);
    }

    public function actionCategory($parent_cat_alias = '', $alias) {
        $category = Categories::find()->where(['cat_alias' => $alias])->one();
        if (!$category) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $subcategories = Categories::find()->where([
            'cat_status' => [Categories::STATUS_ACTIVE],
            'cat_parent' => $category->cat_id,
        ])->all();

        $products = null;
        if (!$subcategories) {
            $products = Products::find()->where([
                'prod_status' => [Products::STATUS_ACTIVE],
                'prod_category' => $category->cat_id,
            ])->all();

            return $this->render('/products/products', [
                'category' => $category,
                'subcategories' => $subcategories,
                'products' => $products,
            ]);
        }

        return $this->render('category', [
            'category' => $category,
            'subcategories' => $subcategories,
            'products' => $products,
        ]);
    }
}
