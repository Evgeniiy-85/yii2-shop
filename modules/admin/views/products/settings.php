<?php
use yii\widgets\ActiveForm;
use app\components\Helpers;
use app\components\UI;
use yii\helpers\Html;

$this->title = 'Основные настройки';
$this->params['breadcrumbs'][] = strip_tags($this->title);?>

<div class="row">
    <div class="col-md-5">
        <?$form = ActiveForm::begin([
            'id' => 'form-settings',
            'action' => "/admin/{$this->context->id}",
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]);?>
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab_link_1" data-toggle="pill" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true">Общее</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab_link_2" data-toggle="pill" href="#tab_2" role="tab" aria-controls="tab_2" aria-selected="false">Почта</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab_link_3" data-toggle="pill" href="#tab_3" role="tab" aria-controls="tab_3" aria-selected="false">Normal Tab</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade active show" id="tab_1" role="tabpanel" aria-labelledby="tab_link_1">
                        <div class="overlay-wrapper">
                            <?= $form->field($settings, 'site_name')->input('text'); ?>
                            <div class="form-group">
                                <label for="input_file">Аватар (в панели управления)</label>
                                <div class="input-group">
                                    <label class="btn bg-purple input-file">
                                        <text><span class="fa fa-cloud-upload"></span>&nbsp; Загрузить изображение</text>
                                        <?=Html::activeFileInput($files, 'image', ['class' => 'custom-file-input hidden']) ?>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input_file">Favicon</label>
                                <div class="input-group">
                                    <label class="btn bg-purple input-file">
                                        <text><span class="fa fa-cloud-upload"></span>&nbsp; Загрузить изображение</text>
                                        <?=Html::activeFileInput($files, 'image', ['class' => 'custom-file-input hidden']) ?>
                                    </label>
                                </div>
                            </div>
                            <?= $form->field($settings, 'admin_email')->input('email'); ?>
                            <?= $form->field($settings, 'currency')->input('text'); ?>
                            <?= $form->field($settings, 'page_count_entries')->input('number'); ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_link_2">
                        <div class="overlay-wrapper">
                            <div class="overlay dark"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Loading...</div></div>
                            Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab_3" role="tabpanel" aria-labelledby="tab_link_3">
                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <?ActiveForm::end();?>
    </div>
</div>


