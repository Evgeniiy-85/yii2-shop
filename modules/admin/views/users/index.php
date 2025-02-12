<?php

/* @var $this yii\web\View */
use app\components\Helpers;
use app\components\UI;

$this->title = 'Список пользователей';
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <a href="<?="/admin/{$this->context->id}/add"?>" class="add-new-item mb-3">
                <span>
                    <span class="fa fa-plus"></span> Добавить пользователя
                </span>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?=$this->render('filter', [
                'filter' => $filter,
            ]);?>
        </div>

        <div class="col-md-9">
            <div class="card card-default" id="user-list">
                <div class="card-body overflow-x-auto" style="padding: 0">
                    <table class="table text-nowrap table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
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
                                            <img width="32" height="32" class="img-circle img-bordered-sm" src="<?=$user->user_photo ?: '/images/avatars/no-avatar.png';?>"/>
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
                                                    'href' => "/login/{$user->user_auth_key}",
                                                    'target' => '_blank',
                                                ],
                                                [
                                                    'icon' => 'fa-trash',
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
