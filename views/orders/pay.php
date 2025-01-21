<?php
use yii\helpers\Html;

$this->title = 'Выбор оплаты';?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row order-info mb-5">
        <div class="col-md-9">
            <div class="card card-default">
                <div class="card-body overflow-x-auto" style="padding: 0">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>Наименование товара</th>
                                <th>Количество</th>
                                <th>Цена</th>
                                <th>Итого</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?foreach($products as $product):?>
                                <tr>
                                    <td><?=$product->prod_title;?></td>
                                    <td>1</td>
                                    <td><?=$product->prod_price;?> руб.</td>
                                    <td><?=$product->prod_price;?> руб.</td>
                                </tr>
                            <?endforeach;?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><strong>Сумма</strong></td>
                                <td><?=$product->prod_price;?> руб.</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><strong>Итого</strong></td>
                                <td><?=$product->prod_price;?> руб.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row payments-list">
        <?foreach ($payments as $payment):?>
            <div class="col-md-9 mb-3">
                <div class="card card-default card-payment">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <a class="card_cover" href="/admin/settings/payments/<?=$payment['pay_id'];?>">
                                    <?if($payment['pay_image']):?>
                                        <img src="/load/payments/<?=$payment['pay_image'];?>";?>
                                    <?else:?>
                                        <span class="fa fa-file-image-o" style="font-size: 100px; padding: 24px 0"></span>
                                    <?endif;?>
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="flex-column align-content-center">
                                    <h3 class="info-box-text">
                                        <?=$payment['pay_title'];?>
                                    </h3>

                                    <div>
                                        <?=$payment['pay_desc'];?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 text-right flex-column align-content-center">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success" name="apply"><?=$payment['pay_button_title'];?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?endforeach;?>
    </div>
</div>