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
                    <table class="table text-nowrap table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Изображение</th>
                                <th>Название</th>
                                <th>Артикул</th>
                                <th>Категория</th>
                                <th>Цена, руб.</th>
                                <th>Кол-во</th>
                                <th>Статус</th>
                                <th style="width: 30px"></th>
                            </tr>
                        </thead>

                        <tbody class="product-list">
                            <?php if($products):?>
                                <?foreach($products as $product):?>
                                    <tr>
                                        <td><?=$product->prod_id?></td>
                                        <td>
                                            <div class="card_cover">
                                                <img src="<?=$product->prod_image ? "/load/products/{$product['prod_image']}" : '/images/no-img.png';?>"/>
                                            </div>
                                        </td>
                                        <td width="300">
                                            <a href="<?="/admin/{$this->context->id}/{$product->prod_id}";?>"><?=$product->prod_title?></a>
                                        </td>
                                        <td><?=$product->prod_article;?></td>
                                        <td>
                                            <a href="/admin/categories/<?=$product->prod_category;?>"><?=$product->categories->cat_title;?></a>
                                        </td>
                                        <td><?=Helpers::formatPrice($product->prod_price);?></td>
                                        <td><?=$product->prod_quantity;?></td>
                                        <td><?=Products::getStatuses($product->prod_status);?></td>
                                        <td class="user-action-buttons text-right">
                                            <?=UI::contextMenu([
                                                [
                                                    'icon' => 'fa-external-link-alt',
                                                    'text' => 'Перейти на страницу товара',
                                                    'href' => "/products/{$product->prod_alias}",
                                                    'class' => 'dont-replace-href',
                                                    'target' => '_blank',
                                                ],
                                                [
                                                    'icon' => 'fa-pencil',
                                                    'text' => 'Редактировать',
                                                    'href' => "/admin/{$this->context->id}/{$product->prod_id}",
                                                    'class' => 'dont-replace-href',
                                                ],
                                                [
                                                    'icon' => 'fa-remove',
                                                    'text' => 'Удалить',
                                                    'href' => "/admin/{$this->context->id}/delete/{$product->prod_id}",
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
                    <?=!$products ? 'Ничего не найдено' : '';?>
                </div>
            </div>
        </div>
    </div>
</div>

