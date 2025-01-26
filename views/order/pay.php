<?php
use yii\helpers\Html;

$this->title = 'Выбор оплаты';?>

<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row order-info mb-5">
        <div class="col-md-9">
            <?=$this->render('order_products', [
                'order' => $order,
                'products' => $products,
                'order_items' => $order_items,
            ]);?>
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

                            <div class="col-md-3 text-right flex-column mt-2">
                                <div class="btn-group">
                                    <button type="submit" class="button button-ui btn_a-primary button-small" name="apply" data-target="#modalPay_<?=$payment['pay_name'];?>" data-toggle="modal"><?=$payment['pay_button_title'];?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?endforeach;?>
    </div>
</div>

<?foreach ($payments as $payment) {
    echo $this->render("@app/modules/payments/{$payment['pay_name']}/views/payment/pay", [
        'payment' => $payment,
        'order' => $order,
    ]);
}?>



