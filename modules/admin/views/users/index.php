<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use app\components\UI;
use app\components\Helpers;
use app\models\Users;

$this->title = 'Список пользователей';
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <a href="<?="/admin/{$this->context->id}/add"?>" class="btn btn-block btn-default mb-3">
                Добавить пользователя
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Фильтр</h3>
                </div>

                <?$form = ActiveForm::begin([
                    'id' => 'form-user',
                    'action' => "/admin/{$this->context->id}",
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ]
                ]);?>

                <div class="card-body">
                    <?= $form->field($filter, 'user_email')->input('text'); ?>
                    <?= $form->field($filter, 'full_name')->input('text'); ?>
                    <?= $form
                        ->field($filter, "user_role")
                        ->dropDownList($filter->getRoles(), ['class' => 'form-control', 'prompt' => '-']);
                    ?>
                    <?= $form
                        ->field($filter, "user_status")
                        ->dropDownList(Users::getStatuses(), ['class' => 'form-control', 'prompt' => '-']);
                    ?>
                </div>

                <div class="card-footer text-right">
                    <div class="margin">
                        <div class="btn-group">
                            <a class="btn btn-default" href="/admin/users?reset_filter=1">
                                <span class="fa fa-close"></span> Сбросить
                            </a>
                        </div>

                        <div class="btn-group">
                            <?= Html::submitButton('Применить', ['class' => 'btn btn-primary', 'name' => 'apply']) ?>
                        </div>
                    </div>

                </div>
                <?ActiveForm::end();?>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card card-default" id="user-list">
                <div class="card-header">
                    <h3 class="card-title">Пользователи</h3>
                </div>

                <div class="card-body" style="padding: 0">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Фото</th>
                                <th>ФИО</th>
                                <th>E-mail</th>
                                <th>Телефон</th>
                                <th>Дата регистрации</th>
                                <th>Последний визит</th>
                                <th style="width: 30px"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if($users):?>
                                <?foreach($users as $user):?>
                                    <tr>
                                        <td><a href="<?="/admin/{$this->context->id}/{$user->user_id}";?>"><?=$user->user_id?></a></td>
                                        <td>
                                            <img width="32" height="32" class="img-circle img-bordered-sm" src="<?=$user->user_photo ? $user->user_photo : '/dist/img/guest.jpg';?>"/>
                                        </td>
                                        <td>
                                            <?=$user->user_surname, ' ', $user->user_name, ' ', $user->user_patronymic?>
                                        </td>
                                        <td><?=$user->user_email?></td>
                                        <td><?=$user->user_phone?></td>
                                        <td><?=Helpers::getDate($user->user_create_date)?></td>
                                        <td><?=Helpers::getDate($user->user_last_visit_date)?></td>
                                        <td class="user-action-buttons text-right">
                                            <?=UI::contextMenu([
                                                [
                                                    'icon' => 'fa-pencil',
                                                    'text' => 'Редактировать',
                                                    'href' => "/admin/{$this->context->id}/{$user->user_id}",
                                                    'class' => 'dont-replace-href',
                                                ],
                                                [
                                                    'icon' => 'fa-sign-in',
                                                    'text' => 'Войти под пользователем',
                                                    'href' => Yii::$app->params['panelHost'] . "/login/{$user->user_auth_key}",
                                                    'target' => '_blank',
                                                ],
                                                [
                                                    'icon' => 'fa-remove',
                                                    'text' => 'Удалить',
                                                    'href' => "/admin/{$this->context->id}/delete/{$user->user_id}",
                                                    'onclick' => 'return confirm(\'Точно удалить?\')',
                                                ]
                                            ], ['class' => 'float-right'])?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?endif;?>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <?=!$users ? 'Ничего не найдено' : '';?>
                </div>
            </div>
        </div>
    </div>
</div>
