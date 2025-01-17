<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Categories;

$this->title = 'Редактировать категорию';
$this->params['breadcrumbs'][] = ['label' => 'Список категорий', 'url' => ['/admin/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] = strip_tags($this->title);

$categories = Categories::find()
    ->select(['cat_title'])
    ->where([
        'cat_status' => Categories::STATUS_ACTIVE,
        'cat_parent' => '0',
    ])
    ->indexBy('cat_id')
    ->column();
?>

<?=$model->showNotices();?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Редактировать категорию</h3>
                </div>

                <?$form = ActiveForm::begin([
                    'id' => 'form-category',
                    'action' => "/admin/{$this->context->id}/{$model->cat_id}",
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ]
                ]);?>

                <div class="card-body">
                    <?= $form->field($model, 'cat_title')->input('text'); ?>
                    <?= $form->field($model, 'cat_alias')->input('text'); ?>
                    <div class="form-group">
                        <label for="input_file">Обложка</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <?=Html::activeFileInput($files, 'image', ['class' => 'custom-file-input', 'id' => 'input_file']) ?>
                                <label class="custom-file-label" for="input_file"><?=$model->cat_image;?></label>
                            </div>
                        </div>
                    </div>
                    <?= $form->field($model, 'cat_sort')->input('number'); ?>
                    <?= $form
                        ->field($model, "cat_parent")
                        ->dropDownList($categories, ['class' => 'form-control', 'prompt' => '-']);
                    ?>
                    <?= $form
                        ->field($model, "cat_status")
                        ->dropDownList(Categories::getStatuses(), ['class' => 'form-control']);
                    ?>
                    <?=Html::activeInput('hidden', $model, 'cat_id');?>
                </div>

                <div class="card-footer">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary float-right', 'name' => 'save']) ?>
                </div>

                <?ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>
