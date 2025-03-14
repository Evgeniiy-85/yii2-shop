<?php

namespace app\modules\payments\custom\controllers;

use app\models\Order;
use app\modules\admin\models\Notices;
use app\modules\payments\custom\models\PayCustom;
use app\controllers\BaseController;
use Yii;


class PaymentController extends BaseController {

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
            $order->save() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при сохранении');
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
