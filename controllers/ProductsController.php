<?php

namespace app\controllers;

use app\components\Helpers;
use app\models\Category;
use app\models\Favorites;
use app\models\Product;
use app\models\ProductFilter;
use yii\data\Pagination;
use app\controllers\BaseController;
use yii\web\HttpException;
use Yii;
use app\models\ProductReview;

class ProductsController extends BaseController {

    public function actionSearch() {
        $query = Product::find()->where([
            'prod_status' => [Product::STATUS_ACTIVE],
        ]);

        $filter = new ProductFilter();
        if (Yii::$app->request->get('filter') == 'apply' && $filter->load(Yii::$app->request->get()) && $filter->validate()) {
            $filter->add($query);
        }

        if (Yii::$app->request->get('q')) {
            Product::search(urldecode(Yii::$app->request->get('q')), $query);
        }

        $product_count = $query->count();

        return $this->render('search', [
            'products' => $query->all(),
            'product_count' => $product_count,
            'filter' => $filter,
        ]);
    }


    public function actionProduct($alias) {
        $product = Product::find()->where(['prod_alias' => $alias])->one();
        if (!$product) {
            throw new HttpException(404, "Страница не найдена.");
        }

        $category = null;
        if ($product['prod_category']) {
            $category = Category::find()->where(['cat_id' => $product['prod_category']])->one();
        }

        $count_reviews = ProductReview::find()
            ->where([
                'prod_id' => $product['prod_id'],
                'review_status' => ProductReview::STATUS_ACTIVE
            ])
            ->count('review_id');

        $product_rating = $count_reviews ? number_format(ProductReview::find()
                ->where([
                    'prod_id' => $product['prod_id'],
                    'review_status' => ProductReview::STATUS_ACTIVE
                ])
                ->sum('review_rating') / $count_reviews, 1) : false;

        return $this->render('product', [
            'product' => $product,
            'category' => $category,
            'product_rating' => $product_rating,
            'count_reviews' => $count_reviews,
        ]);
    }


    public function actionBuy() {
        return $this->render('buy');
    }
}
