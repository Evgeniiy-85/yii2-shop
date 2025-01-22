<?php

namespace app\modules\payments\custom\controllers;

use app\models\Order;
use app\modules\payments\custom\models\PayCustom;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin` module
 */
class PaymentController extends Controller {

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
     * @param $order_id
     * @return void
     * @throws \yii\db\Exception
     */
    public function actionPay($order_id) {
        $order = Order::find()->where(['order_id' => $order_id])->one();
        $payment = new PayCustom();

        if ($payment->load(Yii::$app->request->post()) && $payment->validate()) {
            $order->order_params = $payment->getOrderInfo();
            $order->setStatus(Order::STATUS_INVOICE_ISSUED);
            $order->save();
        }

        $this->redirect("/pay/success");
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        echo '!!!222';exit;
        return $this->render('index');
    }
}
