<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\User;

$this->title = 'Добавить пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Список пользователей', 'url' => ['/admin/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<?=$model->showNotices();?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Новый пользователь</h3>
                </div>

                <?$form = ActiveForm::begin([
                    'id' => 'form-user',
                    'action' => "/admin/{$this->context->id}/add",
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ]
                ]);?>

                <div class="card-body">
                    <?= $form->field($model, 'user_email')->input('text'); ?>
                    <?= $form->field($model, 'user_name')->input('text'); ?>
                    <?= $form->field($model, 'user_surname')->input('text'); ?>
                    <?= $form->field($model, 'user_patronymic')->input('text'); ?>
                    <?= $form->field($model, 'user_phone')->input('text'); ?>
                    <?= $form
                        ->field($model, "user_role")
                        ->dropDownList($model->getRoles(), ['class' => 'form-control',]);
                    ?>
                    <?= $form->field($model, 'user_password')->input('text'); ?>
                    <?= $form
                        ->field($model, "user_status")
                        ->dropDownList(User::getStatuses(), ['class' => 'form-control']);
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

