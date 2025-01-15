<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Редактировать продукт';
$this->params['breadcrumbs'][] = ['label' => 'Список продуктов', 'url' => ['/admin/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<?=$model->showNotices();?>

<div class="row">
    <div class="col-md-5">
        <div class="box card-primary">
            <div class="card-header with-border">
                <h3 class="card-title">Редактировать продукт</h3>
            </div>

            <?$form = ActiveForm::begin([
                'id' => 'form-product',
                'action' => "/admin/{$this->context->id}/{$model->prod_id}",
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]);?>

            <div class="card-body">
                <?= $form->field($model, 'prod_title')->input('text'); ?>
                <?= $form->field($model, 'prod_alias')->input('text'); ?>
                <?= $form->field($model, 'prod_image')->input('text'); ?>
                <?= $form->field($model, 'prod_price')->input('text'); ?>
                <?=Html::activeInput('hidden', $model, 'prod_id');?>
            </div>

            <div class="card-footer">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary float-right', 'name' => 'save']) ?>
            </div>

            <?ActiveForm::end();?>
        </div>
    </div>
</div>
