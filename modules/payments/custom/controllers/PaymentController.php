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

    public $layout = '@app/views/layouts/main';

    /**
     * @param $order_id
     * @return void
     * @throws \yii\db\Exception
     */
    public function actionPay($order_id) {
        $order = Order::find()->where(['order_id' => $order_id])->one();
        $payment = new PayCustom();

        if ($payment->load(Yii::$app->request->post()) && $payment->validate()) {
            $order->setAttribute('order_params', $payment->getOrderInfo());
            $order->setAttribute('order_status', Order::STATUS_INVOICE_ISSUED);
            $order->save();
        }

        $this->redirect("/pay/custom/success");
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionSuccess() {
        return $this->render('success');
    }
}
