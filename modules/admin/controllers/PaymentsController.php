<?php

namespace app\modules\admin\controllers;

use app\models\Payments;
use app\models\Products;
use app\modules\admin\models\ProductsFilter;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin` module
 */
class PaymentsController extends SettingsController {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'manager']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'actions' => ['admin/auth/logout'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['?'],
                        'matchCallback' => function ($rule, $action) {
                            return $this->redirect(['/admin/auth/login'])->send();
                        }
                    ]
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action) {
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result){
        return parent::afterAction($action, $result);
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $query = Payments::find();
        $filter = new ProductsFilter();
        $filter->add($query);

        $query
            ->orderBy(['pay_id' => SORT_DESC]);

        return $this->render('/settings/payments/index', [
            'payments' => $query->all(),
        ]);
    }

    public function actionEdit() {

    }
}
