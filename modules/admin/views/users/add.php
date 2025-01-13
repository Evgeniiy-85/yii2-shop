<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Users;

$this->title = 'Добавить пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Список пользователей', 'url' => ['/admin/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<?=$model->showNotices();?>

<div class="row">
    <div class="col-xs-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Добавить пользователя</h3>
            </div>

            <?$form = ActiveForm::begin([
                'id' => 'form-user',
                'action' => "/admin/{$this->context->id}/add",
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]);?>

            <div class="box-body">
                <?= $form->field($model, 'user_email')->input('text'); ?>
                <?= $form->field($model, 'user_name')->input('text'); ?>
                <?= $form->field($model, 'user_surname')->input('text'); ?>
                <?= $form->field($model, 'user_patronymic')->input('text'); ?>
                <?= $form->field($model, 'user_phone')->input('text'); ?>

                <?= $form
                    ->field($model, "user_role")
                    ->dropDownList(Users::getRoles(), ['class' => 'form-control',]);
                ?>
                <?= $form->field($model, 'user_password')->input('text'); ?>
                <?= $form->field($model, 'user_status')->input('number'); ?>
            </div>

            <div class="box-footer">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right', 'name' => 'add']) ?>
            </div>

            <?ActiveForm::end();?>
        </div>
    </div>
</div>

