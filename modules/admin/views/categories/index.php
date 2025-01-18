<?php
use yii\widgets\ActiveForm;
use app\components\Helpers;
use app\components\UI;
use app\models\Categories;

$this->title = 'Список категорий';
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <a href="<?="/admin/{$this->context->id}/add"?>" class="add-new-item ">
                <span>
                    <span class="fa fa-plus"></span> Добавить новую категорию
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
            <div class="card card-default" id="categories">
                <div class="card-body overflow-auto" style="padding: 0">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Изобржение</th>
                                <th>Название</th>
                                <th>Родительская категория</th>
                                <th>Статус</th>
                                <th style="width: 30px"></th>
                            </tr>
                        </thead>

                        <tbody class="product-list">
                        <?php if($categories):?>
                            <?foreach($categories as $category):?>
                                <tr>
                                    <td><a href="<?="/admin/{$this->context->id}/{$category->cat_id}";?>"><?=$category->cat_id?></a></td>
                                    <td>
                                        <div class="card_cover">
                                            <img src="<?=$category->cat_image ? "/load/categories/{$category['cat_image']}" : '/images/no-img.png';?>"/>
                                        </div>
                                    </td>
                                    <td width="300">
                                        <a href="/admin/categories/<?=$category->cat_id;?>"><?=$category->cat_title;?></a>
                                    </td>
                                    <td>
                                        <a href="/admin/categories/<?=$category->cat_parent;?>"><?=$category->parentCategory->cat_title;?></a>
                                    </td>
                                    <td><?=Categories::getStatuses($category->cat_status);?></td>
                                    <td class="user-action-buttons text-right">
                                        <?=UI::contextMenu([
                                            [
                                                'icon' => 'fa-external-link-alt',
                                                'text' => 'Перейти на страницу категории',
                                                'href' => "/categories/{$category->cat_alias}",
                                                'class' => 'dont-replace-href',
                                                'target' => '_blank',
                                            ],
                                            [
                                                'icon' => 'fa-pencil',
                                                'text' => 'Редактировать',
                                                'href' => "/admin/{$this->context->id}/{$category->cat_id}",
                                                'class' => 'dont-replace-href',
                                            ],
                                            [
                                                'icon' => 'fa-remove',
                                                'text' => 'Удалить',
                                                'href' => "/admin/{$this->context->id}/delete/{$category->cat_id}",
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
                    <?=!$categorys ? 'Ничего не найдено' : '';?>
                </div>
            </div>
        </div>
    </div>
</div>

