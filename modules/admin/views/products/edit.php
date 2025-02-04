<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Product;
use app\models\Category;
use yii\jui\Sortable;

$this->title = 'Редактировать продукт';
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
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">
                        <?=$model->prod_title;?>
                        <a href="/products/<?=$model->prod_alias;?>" class="fa fa-external-link-alt" target="_blank"></a>
                    </h3>
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
                    <div class="form-group">
                        <label for="input_file">Фотографии</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <?=Html::activeFileInput($files, 'images[]', ['class' => 'custom-file-input', 'id' => 'add_images', 'multiple' => true]) ?>
                                <label class="custom-file-label" for="add_images"><?=$model->prod_image;?></label>
                            </div>

                            <div class="attachments" data-dir="products">
                                <?if($model->prod_images) {
                                    echo $this->render('/attachments/images', [
                                        'files' => $files,
                                        'dir' => 'products'
                                    ]);
                                }?>
                            </div>
                        </div>
                    </div>
                    <?= $form->field($model, 'prod_article')->input('text'); ?>
                    <?= $form->field($model, 'prod_price')->input('text'); ?>
                    <?= $form
                        ->field($model, "prod_category")
                        ->dropDownList($categories, ['class' => 'form-control', 'prompt' => '-']);
                    ?>
                    <?= $form
                        ->field($model, "prod_status")
                        ->dropDownList(Product::getStatuses(), ['class' => 'form-control']);
                    ?>
                    <?=Html::activeInput('hidden', $model, 'prod_id');?>
                </div>

                <div class="card-footer">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary float-right', 'name' => 'save']) ?>
                </div>

                <?ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>