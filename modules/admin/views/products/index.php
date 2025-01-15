<?php
use yii\widgets\ActiveForm;

$this->title = 'Список продуктов';
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<div class="row product-list">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <a href="<?="/admin/{$this->context->id}/add"?>" class="add-new-item ">
                    <span>
                        <span class="fa fa-plus"></span> Добавить новый продукт
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <?php if($products):
            foreach ($products as $product):?>
                <div class="col-lg-3 col-xs-12 col-sm-6 col-md-4 col-xl-3">
                    <div class="box card-primary card-product">
                        <div class="card-body row">
                            <div class="col-xs-12">
                                <h4 class="card-title"><span><?=$product['prod_title'];?></span>
                                    <a class="fa fa-external-link" target="_blank" href="/products/<?=$product['prod_alias'];?>"></a>
                                </h4>

                                <a class="product-card_cover" href="/admin/products/<?=$product['prod_id'];?>">
                                    <?if($product['prod_image']):?>
                                        <img src="/images/product/<?=$product['prod_image'];?>";?>
                                    <?else:?>
                                        <span class="fa fa-file-image-o" style="font-size: 100px; padding: 24px 0"></span>
                                    <?endif;?>
                                </a>

                                <div style="white-space: normal;"> </div>
                                <div class="fab-info">Мембершип</div>
                            </div>
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


