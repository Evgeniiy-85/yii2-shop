<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Category;

$this->title = 'Редактировать категорию';
$this->params['breadcrumbs'][] = ['label' => 'Список категорий', 'url' => ['/admin/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] = strip_tags($this->title);

$categories = Category::find()
    ->select(['cat_title'])
    ->where([
        'cat_status' => Category::STATUS_ACTIVE,
    ])
    ->andWhere(['<>','cat_id', $model->cat_id])
    ->indexBy('cat_id')
    ->column();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">
                        <?=$model->cat_title;?>
                        <a href="/categories/<?=$model->cat_alias;?>" class="fa fa-external-link-alt" target="_blank"></a>
                    </h3>
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
                            <label class="btn bg-purple input-file" for="add_images">
                                <text><span class="fa fa-cloud-upload"></span>&nbsp; Загрузить изображение</text>
                                <?=Html::activeFileInput($files, 'image', ['class' => 'custom-file-input hidden', 'id' => 'add_images']) ?>
                            </label>

                            <?=$this->render('/attachments/image', [
                                'files' => $files,
                            ]);?>
                        </div>
                    </div>
                    <?= $form->field($model, 'cat_sort')->input('number'); ?>
                    <?= $form
                        ->field($model, "cat_parent")
                        ->dropDownList($categories, ['class' => 'form-control', 'prompt' => '-']);
                    ?>
                    <?= $form
                        ->field($model, "cat_status")
                        ->dropDownList(Category::getStatuses(), ['class' => 'form-control']);
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
