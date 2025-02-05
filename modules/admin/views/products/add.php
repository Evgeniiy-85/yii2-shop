<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Product;
use app\models\Category;

$this->title = 'Добавить продукт';
$this->params['breadcrumbs'][] = ['label' => 'Список продуктов', 'url' => ['/admin/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] = strip_tags($this->title);

$categories = Category::find()
    ->select(['cat_title'])
    ->where([
        'cat_status' => Category::STATUS_ACTIVE,
    ])
    ->indexBy('cat_id')
    ->column();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Новый продукт</h3>
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
                        <label>Фотографии</label>
                        <div class="input-group">
                            <label class="btn bg-purple input-file" for="add_images">
                                <text><span class="fa fa-cloud-upload"></span>&nbsp; Загрузить изображения</text>
                                <?=Html::activeFileInput($files, 'images[]', ['class' => 'custom-file-input hidden', 'id' => 'add_images', 'multiple' => true]) ?>
                            </label>

                            <?=$this->render('/attachments/images', [
                                'files' => $files,
                                'dir' => 'products'
                            ]);?>
                        </div>
                    </div>
                    <?= $form->field($model, 'prod_article')->input('text'); ?>
                    <?= $form
                        ->field($model, "prod_category")
                        ->dropDownList($categories, ['class' => 'form-control', 'prompt' => '-']);
                    ?>
                    <?= $form->field($model, 'prod_price')->input('text'); ?>
                    <?= $form
                        ->field($model, "prod_status")
                        ->dropDownList(Product::getStatuses(), ['class' => 'form-control', 'options'=> [Product::STATUS_ACTIVE => ['Selected' => true]]]);
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

