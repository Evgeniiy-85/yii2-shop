<?php
use yii\widgets\ActiveForm;

?>

<div class="row product-list">
    <?php if($products):
        foreach ($products as $product):?>
            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-4 col-xl-3">
                <div class="box box-primary box-product">
                    <div class="box-body row">
                        <div class="col-xs-12">
                            <h4 class="box-title"><span><?=$product['prod_title'];?></span>
                                <a class="fa fa-external-link" target="_blank" href="/catalog/product/<?=$product['prod_id'];?>"></a>
                            </h4>

                            <a class="product-card_cover" href="/admin/products/<?=$product['prod_id'];?>">
                                <img src="/images/product/<?=$product['prod_image'];?>";?>
                            </a>

                            <div style="white-space: normal;"> </div>
                            <div class="fab-info">Мембершип</div>
                        </div>
                    </div>

                    <div class="box-footer" style="color: #aaa; font-size: 12px;">
                        <span class="fa fa-clock-o"></span> 22 февраля 2018 г. в 10:04
                    </div>
                </div>
            </div>
        <?endforeach;?>
    <?endif;?>
</div>


