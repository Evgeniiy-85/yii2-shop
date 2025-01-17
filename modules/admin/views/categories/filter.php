<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Products;?>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Фильтр</h3>
    </div>

    <?$form = ActiveForm::begin([
        'id' => 'form-categories',
        'action' => "/admin/{$this->context->id}",
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]);?>

    <div class="card-body">
        <?= $form->field($filter, 'cat_title')->input('text'); ?>
        <?= $form
            ->field($filter, "cat_status")
            ->dropDownList(Products::getStatuses(), ['class' => 'form-control', 'prompt' => '-']);
        ?>
    </div>

    <div class="card-footer text-right">
        <div class="margin">
            <?if($filter->is_filter):?>
                <div class="btn-group">
                    <a class="btn btn-default" href="/admin/categories?reset_filter=1">
                        <span class="fa fa-close"></span> Сбросить
                    </a>
                </div>
            <?endif;?>

            <div class="btn-group">
                <?= Html::submitButton('Применить', ['class' => 'btn btn-primary', 'name' => 'apply']) ?>
                <input type="hidden" name="is_filter" value="1"/>
            </div>
        </div>

    </div>
    <?ActiveForm::end();?>
</div>