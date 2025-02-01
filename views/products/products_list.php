<?php
use yii\helpers\Html;
use app\components\Helpers;?>

<div class="products-list">
    <?if($products):
        foreach ($products as $product):?>
            <div class="product">
                <div class="product-cover">
                    <img src="/load/products/<?=$product['prod_image'];?>">
                </div>

                <div class="product-center">
                    <a class="product-title" href="/products/<?=$product['prod_alias'];?>"><?=$product['prod_title'];?></a>

                    <div class="card-bottom">Наличите: в наличии</div>
                </div>

                <div class="product-right">
                    <div class="product-price">
                        <?=Helpers::formatPrice($product['prod_price']);?> ₽
                    </div>

                    <div class="product-buttons">
                        <div class="product-favorites">
                            <?=Html::button('', [
                                'class' => ['button', 'button-ui', 'btn_a-grey'],
                                'type' => 'button',
                                'data' => [
                                    'prod_id' => $product['prod_id'],
                                    'action_type' => 'add',
                                ],
                            ]);?>
                        </div>

                        <div class="product-by">
                            <?=Html::button('Купить', [
                                'class' => ['button', 'button-ui', 'btn_a-outline-primary'],
                                'type' => 'button',
                                'data' => [
                                    'prod_id' => $product['prod_id'],
                                    'action_type' => 'append',
                                ],
                            ]);?>
                        </div>
                    </div>

                </div>
            </div>
        <?endforeach;
    else:?>
        <div class="empty-result">
            <h3>Ничего не найдено</h3>
        </div>
    <?endif;?>
</div>