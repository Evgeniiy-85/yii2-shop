<?php

namespace app\controllers\backend;

use yii\filters\AccessControl;
use yii\web\Controller;

class ProductsController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['Administrator']
                    ],
                ]
            ]
        ];
    }
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        echo '!!!';exit;
    }
}