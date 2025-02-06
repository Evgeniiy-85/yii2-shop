<?php

namespace app\modules\admin\controllers;

use app\components\Helpers;
use app\models\Order;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use app\models\User;

/**
 * Default controller for the `admin` module
 */
class AdminController extends Controller {

    public $layout = '@app/modules/admin/views/layouts/main';

    public function behaviors() {
        return [
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
        $statistics = [];
        $order = new Order();
        $user = new User();
        $today = strtotime(date('d-m-Y 00:00:00'));

        $new_orders = $order->find()
            ->where(['>=', 'order_date', $today])
            ->count();
        $pay_orders = $order->find()
            ->where(['>=', 'payment_date', $today])
            ->andWhere(['order_status' => 1])
            ->count();
        $new_clients = $user->find()
            ->leftJoin('auth_assignment', 'auth_assignment.user_id = users.user_id')
            ->innerJoin('orders', 'orders.client_email = users.user_email')
            ->where(['auth_assignment.item_name' => 'user'])
            ->andWhere(['>=', 'users.created_at', $today])
            ->count();
        $new_orders_sum = $order->find()->where(['>=', 'payment_date', $today])->sum('order_sum');

        $chart = [
            'months' => [],
            'count' => [],
        ];

        $date = strtotime(date('1-m-Y 00:00:00', time()));
        for ($i = 6; $i >= 0; $i--) {
            $start_date = strtotime("-$i month", $date);
            $end_date = strtotime("+1 month", $start_date);
            $count = $order->find()
                ->where(['>=', 'payment_date', $start_date])
                ->andWhere(['<', 'payment_date', $end_date])
                ->andWhere(['order_status' => 1])
                ->count();
            $chart['months'][] = Helpers::getMonthNameByNum(date('m', $start_date));
            $chart['count'][] = $count;
        }

        return $this->render('index', [
            'statistics' => [
                'new_orders' => $new_orders,
                'pay_orders' => $pay_orders,
                'new_clients' => $new_clients,
                'new_orders_sum' => (int)$new_orders_sum,
                'chart' => $chart,
            ]
        ]);
    }
}
