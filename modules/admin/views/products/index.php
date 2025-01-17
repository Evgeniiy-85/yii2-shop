<?php
use yii\widgets\ActiveForm;

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
            <div class="row product-list">
                <?php if($products):
                    foreach ($products as $product):?>
                        <div class="col-md-3">
                            <div class="card card-default card-product">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <?=$product['prod_title'];?></h3>
                                    <a class="external-link fa fa-external-link-alt" target="_blank" href="/products/<?=$product['prod_alias'];?>"></a>
                                </div>

                                <div class="card-body">
                                    <a class="product-card_cover" href="/admin/products/<?=$product['prod_id'];?>">
                                        <?if($product['prod_image']):?>
                                            <img src="/load/products/<?=$product['prod_image'];?>";?>
                                        <?else:?>
                                            <span class="fa fa-file-image-o" style="font-size: 100px; padding: 24px 0"></span>
                                        <?endif;?>
                                    </a>

                                    <div style="white-space: normal;"> </div>
                                    <div class="fab-info">Мембершип</div>
                                </div>

                                <div class="card-footer" style="color: #aaa; font-size: 12px;">
                                    <span class="fa fa-clock-o"></span> 22 февраля 2018 г. в 10:04
                                </div>
                            </div>
                        </div>
                    <?endforeach;?>
                <?endif;?>
            </div>
        </div>
    </div>
</div>

