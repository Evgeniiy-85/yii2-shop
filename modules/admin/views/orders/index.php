<?php
use yii\widgets\ActiveForm;
use app\components\Helpers;
use app\models\Order;
use app\components\UI;

$this->title = 'Список заказов';
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<div class="row product-list">
    <div class="col-md-12">
        <div class="card card-default" id="products">
            <div class="card-body  overflow-x-auto" style="padding: 0">
                <table class="table text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Дата</th>
                        <th>Имя клиента</th>
                        <th>Фамилия клиента</th>
                        <th>E-mail клиента</th>
                        <th>Телефон клиента</th>
                        <th>Стоимость, руб.</th>
                        <th>Статус</th>
                        <th style="width: 30px"></th>
                    </tr>
                    </thead>

                    <tbody class="product-list">
                    <?php if($orders):?>
                        <?foreach($orders as $order):?>
                            <tr>
                                <td><?=$order->order_id?></td>
                                <td><?=Helpers::getDate($order->order_date)?></td>
                                <td><?=$order->client_name;?></td>
                                <td><?=$order->client_surname;?></td>
                                <td><?=$order->client_email;?></td>
                                <td><?=$order->client_phone;?></td>
                                <td><?=Helpers::formatPrice($order->order_sum);?></td>
                                <td><?=Order::getStatuses($order->order_status);?></td>
                                <td class="user-action-buttons text-right">
                                    <?=UI::contextMenu([
                                        [
                                            'icon' => 'fa-external-link-alt',
                                            'text' => 'Перейти на страницу заказа',
                                            'href' => "/pay/{$order->order_id}",
                                            'class' => 'dont-replace-href',
                                            'target' => '_blank',
                                        ],
                                        [
                                            'icon' => 'fa-pencil',
                                            'text' => 'Редактировать',
                                            'href' => "/admin/{$this->context->id}/{$order->order_id}",
                                            'class' => 'dont-replace-href',
                                        ],
                                    ], ['class' => 'float-right'])?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?endif;?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <?=!$orders ? 'Ничего не найдено' : '';?>
            </div>
        </div>
    </div>
</div>


