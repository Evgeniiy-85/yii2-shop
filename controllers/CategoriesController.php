<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\ProductFilter;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;
use Yii;

class CategoriesController extends Controller {

    public function actionIndex() {
        $page_size = 36;

        $query = Category::find()->where([
            'cat_status' => [Category::STATUS_ACTIVE],
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
        $category = Category::find()->where(['cat_alias' => $alias])->one();
        if (!$category) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $subcategories = Category::find()->where([
            'cat_status' => [Category::STATUS_ACTIVE],
            'cat_parent' => $category->cat_id,
        ])->all();

        if (!$subcategories) {
            $query = Product::find()->where([
                'prod_status' => [Product::STATUS_ACTIVE],
                'prod_category' => $category->cat_id,
            ]);

            $filter = new ProductFilter();
            $filter->prod_category = $category->cat_id;

            if ($filter->load(Yii::$app->request->get()) && $filter->validate()) {
                $filter->add($query);
            }

            return $this->render('/products/products', [
                'category' => $category,
                'subcategories' => $subcategories,
                'products' => $query->all(),
                'filter' => $filter,
            ]);
        }

        return $this->render('category', [
            'category' => $category,
            'subcategories' => $subcategories,
        ]);
    }
}
