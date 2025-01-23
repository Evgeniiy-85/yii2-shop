<?php use yii\helpers\Html;
use app\components\Helpers;
use yii\helpers\Url;?>

<div class="card-body overflow-x-auto" style="padding: 0">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Итого</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?foreach($basket->products as $prod_id => $product):
                    $quantity = $basket->quantity[$prod_id];?>
                    <tr>
                        <td><?=Html::encode($product->prod_title);?></td>
                        <td><?=$quantity;?></td>
                        <td><nobr><?=Helpers::formatPrice($product->prod_price);?> руб.</nobr></td>
                        <td><nobr><?=Helpers::formatPrice($product->prod_price * $quantity);?> руб.</nobr></td>
                        <td>
                            <a href="<?= Url::to(['basket/remove', 'id' => $prod_id]);?>" class="text-danger">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                <?endforeach;?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>Итого</strong></td>
                    <td><?=Helpers::formatPrice($basket->total);?> руб.</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>