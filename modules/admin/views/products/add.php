<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Products;

$this->title = 'Добавить продукт';
$this->params['breadcrumbs'][] = ['label' => 'Список продуктов', 'url' => ['/admin/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<?=$model->showNotices();?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Добавить продукт</h3>
                </div>

                <?$form = ActiveForm::begin([
                    'id' => 'form-product',
                    'action' => "/admin/{$this->context->id}/add",
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ]
                ]);?>

                <div class="card-body">
                    <?= $form->field($model, 'prod_title')->input('text'); ?>
                    <?= $form->field($model, 'prod_alias')->input('text'); ?>
                    <div class="form-group">
                        <label for="input_file">Обложка</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <?=Html::activeFileInput($files, 'image', ['class' => 'custom-file-input', 'id' => 'input_file']) ?>
                                <label class="custom-file-label" for="input_file"><?=$model->prod_image;?></label>
                            </div>
                        </div>
                    </div>
                    <?= $form->field($model, 'prod_price')->input('text'); ?>
                    <?= $form
                        ->field($model, "prod_status")
                        ->dropDownList(Products::getStatuses(), ['class' => 'form-control', 'options'=> [Products::STATUS_ACTIVE => ['Selected' => true]]]);
                    ?>
                </div>

                <div class="card-footer">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary float-right', 'name' => 'add']) ?>
                </div>

                <?ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>

