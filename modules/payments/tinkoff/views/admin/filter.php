<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Payment;?>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Фильтр</h3>
    </div>

    <?$form = ActiveForm::begin([
        'id' => 'form-payments',
        'action' => "/admin/{$this->context->id}",
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]);?>

    <div class="card-body">
        <?= $form->field($filter, 'pay_title')->input('text'); ?>
        <?= $form
            ->field($filter, "pay_status")
            ->dropDownList(Payment::getStatuses(), ['class' => 'form-control', 'prompt' => '-']);
        ?>
    </div>

    <div class="card-footer text-right">
        <div class="margin">
            <?if($filter->is_filter):?>
                <div class="btn-group">
                    <a class="btn btn-default" href="/admin/settings/payments?reset_filter=1">
                        <span class="fa fa-close"></span> Сбросить
                    </a>
                </div>
            <?endif;?>

            <div class="btn-group">
                <?= Html::submitButton('Применить', ['class' => 'btn btn-primary', 'name' => 'apply']) ?>
            </div>
        </div>

    </div>
    <?ActiveForm::end();?>
</div>