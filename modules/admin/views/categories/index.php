<?php
use app\models\Category;
use app\modules\admin\models\Notices;

$this->title = 'Список категорий';
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<?=Notices::showNotices();?>

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
                <div class="card-body  overflow-x-auto" style="padding: 0">
                    <table class="table text-nowrap table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Изображение</th>
                                <th>Наименование</th>
                                <th>Родительская категория</th>
                                <th>Порядок сортировки</th>
                                <th>Статус</th>
                                <th class="text-right" width="140">Действие</th>
                            </tr>
                        </thead>

                        <tbody class="product-list">
                        <?php if($categories):?>
                            <?foreach($categories as $category):?>
                                <tr>
                                    <td width="160">
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
                                    <td><?=$category->cat_sort;?></td>

                                    <td>
                                        <small class="badge <?=$category->cat_status == Category::STATUS_ACTIVE ? 'badge-success' : 'badge-danger';?>">
                                            <?=Category::getStatuses($category->cat_status);?>
                                        </small>
                                    </td>
                                    <td class="text-right">
                                        <div class="card-tools" style="width:140px;">
                                            <a class="btn btn-tool btn-default bg-gradient-primary" href="<?="/categories/{$category->cat_alias}";?>" target="_blank"><i class="fa fa-external-link-alt"></i></a>
                                            <a class="btn btn-tool btn-default bg-gradient-success" href="<?="/admin/{$this->context->id}/{$category->cat_id}";?>"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-tool btn-default bg-gradient-danger" href="<?="/admin/{$this->context->id}/delete/{$category->cat_id}";?>" onclick="return confirm('Вы уверены?')"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?endif;?>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <?=!$categories ? 'Ничего не найдено' : '';?>
                </div>
            </div>
        </div>
    </div>
</div>

