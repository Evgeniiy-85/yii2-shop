<?php
use app\modules\admin\models\Notices;

$this->title = 'Платежные модули';
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<?=Notices::showNotices();?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <?=$this->render('filter', [
                        'filter' => $filter,
                    ]);?>
                </div>

                <div class="col-md-9">
                    <div class="row payments-list">
                        <?php if($payments):
                            foreach ($payments as $payment):?>
                                <div class="col-md-12">
                                    <div class="card card-default card-payment">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <a class="card_cover" href="/admin/settings/payments/<?=$payment['pay_name'];?>">
                                                        <?if($payment['pay_image']):?>
                                                            <img src="/load/payments/<?=$payment['pay_image'];?>";?>
                                                        <?else:?>
                                                            <span class="fa fa-file-image-o" style="font-size: 100px; padding: 24px 0"></span>
                                                        <?endif;?>
                                                    </a>
                                                </div>

                                                <div class="col-md-11">
                                                    <div class="flex-column align-content-center">
                                                        <h3 class="info-box-text">
                                                            <?=$payment['pay_title'];?>
                                                        </h3>

                                                        <div>
                                                            <?=$payment['pay_desc'];?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?endforeach;?>
                        <?endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
