<?php
use yii\widgets\ActiveForm;
use app\models\Products;
use app\components\UI;
use app\components\Helpers;

$this->title = 'Список продуктов';
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <a href="<?="/admin/{$this->context->id}/add"?>" class="add-new-item ">
                <span>
                    <span class="fa fa-plus"></span> Добавить новый продукт
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
            <div class="card card-default" id="products">
                <div class="card-body  overflow-x-auto" style="padding: 0">
                    <table class="table text-nowrap table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Изображение</th>
                                <th>Название</th>
                                <th width="140">Артикул</th>
                                <th>Категория</th>
                                <th>Цена, руб.</th>
                                <th>Кол-во</th>
                                <th>Статус</th>
                                <th class="text-right" width="140">Действие</th>
                            </tr>
                        </thead>

                        <tbody class="product-list">
                            <?php if($products):?>
                                <?foreach($products as $product):?>
                                    <tr>
                                        <td>
                                            <div class="card_cover">
                                                <img src="<?=$product->prod_image ? "/load/products/{$product['prod_image']}" : '/images/no-img.png';?>"/>
                                            </div>
                                        </td>
                                        <td width="300">
                                            <a href="<?="/admin/{$this->context->id}/{$product->prod_id}";?>"><?=$product->prod_title?></a>
                                        </td>
                                        <td>
                                            <div style="width:140px;" class="text-truncate"><?=$product->prod_article;?></div>
                                        </td>
                                        <td>
                                            <a href="/admin/categories/<?=$product->prod_category;?>"><?=$product->categories->cat_title;?></a>
                                        </td>
                                        <td><?=Helpers::formatPrice($product->prod_price);?></td>
                                        <td><?=$product->prod_quantity;?></td>
                                        <td>
                                            <small class="badge <?=$product->prod_status == Products::STATUS_ACTIVE ? 'badge-success' : 'badge-danger';?> color-palette">
                                                <span><?=Products::getStatuses($product->prod_status);?></span>
                                            </small>
                                        </td>
                                        <td class="text-right">
                                            <div class="card-tools" style="width:140px;">
                                                <a class="btn btn-tool btn-default bg-gradient-primary" href="<?="/products/{$product->prod_alias}";?>" target="_blank"><i class="fa fa-external-link-alt"></i></a>
                                                <a class="btn btn-tool btn-default bg-gradient-success" href="<?="/admin/{$this->context->id}/{$product->prod_id}";?>"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-tool btn-default bg-gradient-danger" href="<?="/admin/{$this->context->id}/delete/{$product->prod_id}";?>" onclick="return confirm('Вы уверены?')"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?endif;?>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <?=!$products ? 'Ничего не найдено' : '';?>
                </div>
            </div>
        </div>
    </div>
</div>

