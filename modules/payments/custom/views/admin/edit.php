<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Product;
use app\models\Category;

$this->title = 'Редактировать платежный модуль';
$this->params['breadcrumbs'][] = ['label' => 'Список продуктов', 'url' => ['/admin/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<?=$model->showNotices();?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title"><?=$model->pay_title;?></h3>
                </div>

                <?$form = ActiveForm::begin([
                    'id' => 'form-payment',
                    'action' => "/admin/settings/payments/custom",
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ]
                ]);?>

                <div class="card-body">
                    <?= $form->field($model, 'pay_title')->input('text'); ?>
                    <div class="form-group">
                        <label for="input_file">Иконка</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <?=Html::activeFileInput($files, 'image', ['class' => 'custom-file-input', 'id' => 'input_file']) ?>
                                <label class="custom-file-label" for="input_file"><?=$model->pay_image;?></label>
                            </div>
                        </div>
                    </div>
                    <?= $form
                        ->field($model, "pay_desc", ['options' => ['class' => 'form-group']])
                        ->textArea([
                            'rows' => '4',
                            'style' => 'width: 100%',
                            'class' => 'wysiwyg'
                    ]);?>
                    <?= $form
                        ->field($model, "pay_status")
                        ->dropDownList(Product::getStatuses(), ['class' => 'form-control']);
                    ?>
                    <?=Html::activeInput('hidden', $model, 'pay_id');?>
                </div>

                <div class="card-footer">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary float-right', 'name' => 'save']) ?>
                </div>

                <?ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>
