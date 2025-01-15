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

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <a href="<?="/admin/{$this->context->id}/add"?>" class="add-new-item ">
                    <span>
                        <span class="fa fa-plus"></span> Добавить нового пользователя
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <?php if($users):?>
            <div class="card card-primary" id="user-list">
                <div class="card-body" style="padding: 0">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr style="background: #3c8dbc; color: #fff; font-size: 11px;">
                                <th width="80">ID</th>
                                <th width="90">Фото</th>
                                <th width="20%">ФИО</th>
                                <th>E-mail</th>
                                <th>Телефон</th>
                                <th>Дата регистрации</th>
                                <th>Последний визит</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
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
                                    <td></td>
                                    <td></td>
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
                        </tbody>
                    </table>
                </div>
            <?endif;?>
        </div>
    </div><!--.col-md-9-->
</div><!--.row-->
