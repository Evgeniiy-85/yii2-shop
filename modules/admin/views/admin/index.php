<?php
use app\components\Helpers;
use app\modules\admin\models\Notices;?>

<?=Notices::showNotices();?>

<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?=$statistics['new_orders'];?></h3>
                    <p>Новых заказов</p>
                </div>

                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?=$statistics['pay_orders'];?></h3>
                    <p>Оплаченных заказов</p>
                </div>

                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?=Helpers::formatPrice($statistics['new_orders_sum']);?> р.</h3>
                    <p>Заработано</p>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-orange color-palette">
                <div class="inner">
                    <h3><?=$statistics['new_clients'];?></h3>
                    <p>Новых клиентов</p>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Продажи
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;" data-chart='<?=json_encode($statistics['chart'], JSON_UNESCAPED_UNICODE);?>'>
                            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                            <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
    </div>
</div>