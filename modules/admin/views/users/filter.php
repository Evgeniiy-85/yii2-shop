<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;?>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Фильтр</h3>
    </div>

    <?$form = ActiveForm::begin([
        'id' => 'form-users',
        'action' => "/admin/{$this->context->id}",
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]);?>

    <div class="card-body">
        <?= $form->field($filter, 'user_email')->input('text'); ?>
        <?= $form->field($filter, 'full_name')->input('text'); ?>
        <?= $form
            ->field($filter, "user_role")
            ->dropDownList($filter->getRoles(), ['class' => 'form-control', 'prompt' => '-']);
        ?>
        <?= $form
            ->field($filter, "user_status")
            ->dropDownList(Users::getStatuses(), ['class' => 'form-control', 'prompt' => '-']);
        ?>
    </div>

    <div class="card-footer text-right">
        <div class="margin">
            <?if($filter->is_filter):?>
                <div class="btn-group">
                    <a class="btn btn-default" href="/admin/users?reset_filter=1">
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