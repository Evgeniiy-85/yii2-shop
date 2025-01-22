<?php

use app\modules\payments\custom\models\PayCustom;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new PayCustom()?>

<div class="modal fade " id="modalPay_<?=$payment['pay_name'];?>" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center width-100">
                    <h4 class="modal-title">К оплате <?=$order['order_sum'];?> р.</h4>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <?$form = ActiveForm::begin([
                    'id' => 'form-pay-tinkoff',
                    'action' => "/payments/custom/pay/{$order->order_id}",
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ]
                ]);?>

                <div>
                    <?= $form->field($model, 'organization')->input('text'); ?>
                    <?= $form->field($model, 'inn')->input('text'); ?>
                    <?= $form->field($model, 'bik')->input('text'); ?>
                    <?= $form->field($model, 'billing_number')->input('text'); ?>
                    <?= $form->field($model, 'address')->input('text'); ?>
                </div>

                <div>
                    <?= Html::submitButton('Выписать счет', ['class' => 'btn btn-success float-right', 'name' => 'send']) ?>
                </div>

                <?ActiveForm::end();?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>