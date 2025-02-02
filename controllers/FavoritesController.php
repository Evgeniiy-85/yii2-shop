<?php

namespace app\controllers;

use app\models\Category;
use app\models\Favorites;
use app\models\Product;
use app\models\ProductFilter;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;
use Yii;

class FavoritesController extends Controller {

    public function actionIndex() {
        $favorites = new Favorites();
        $f_products = $favorites->getProducts();

        $products = $f_products ? Product::find()
            ->where(['prod_status' => [Product::STATUS_ACTIVE]])
            ->andWhere(['in', 'prod_id', array_keys($f_products)])
            ->all() : [];

        return $this->render('/products/favorites', [
            'products' => $products,
        ]);
    }


    public function actions() {
        if (Yii::$app->request->isAjax && $data = Yii::$app->request->post()) {
            $this->layout = false;

            if (!isset($data['action_type'])) {
                exit;
            }

            $favorites = new Favorites();
            $products = $favorites->getProducts();
            $product_id = (int)($data['prod_id'] ?? 0);
            $status = true;

            switch($data['action_type']) {
                case 'get':
                    $products = $favorites->getProducts();
                    break;
                case 'add':
                    $status = $product_id && $favorites->addProduct($product_id);
                    break;
                case 'remove':
                    $status = $product_id && $favorites->removeProduct($product_id);
                    break;
            }

            exit(json_encode([
                'status' => $status,
                'products' => $products,
            ]));
        }
    }
}
