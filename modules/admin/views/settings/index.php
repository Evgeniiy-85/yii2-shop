<?php
use yii\widgets\ActiveForm;
use app\components\Helpers;
use app\components\UI;
use yii\helpers\Html;
use app\models\Settings;

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
                        <a class="nav-link active" id="tab_link_1" data-toggle="pill" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true">Общие</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab_link_2" data-toggle="pill" href="#tab_2" role="tab" aria-controls="tab_2" aria-selected="false">Служебные</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab_link_3" data-toggle="pill" href="#tab_3" role="tab" aria-controls="tab_3" aria-selected="false">Почта</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab_link_4" data-toggle="pill" href="#tab_4" role="tab" aria-controls="tab_4" aria-selected="false">Внешний вид</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade active show" id="tab_1" role="tabpanel" aria-labelledby="tab_link_1">
                        <div class="overlay-wrapper">
                            <?= $form->field($settings, 'site_name')->input('text'); ?>
                            <?= $form->field($settings, 'admin_email')->input('email'); ?>
                            <?= $form->field($settings, 'currency')->input('text', ['value' => '₽']); ?>
                            <?= $form->field($settings, 'page_count_entries')->input('number', ['value' => 20]); ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_link_2">
                        <div class="overlay-wrapper">
                            <?= $form->field($settings, 'cookie_name')->input('text', ['value' => 'site']); ?>
                            <?= $form->field($settings, 'upload_max_size')->input('number', ['value' => 128]); ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab_3" role="tabpanel" aria-labelledby="tab_link_3">
                        <div class="overlay-wrapper">
                            <?= $form->field($settings, 'mail_send_type')->radioList(Settings::getMailSendTypes(), ['value' => Settings::MAIL_SEND_TYPE_PHP]); ?>
                            <?= $form->field($settings, 'mail_host')->input('number'); ?>
                            <?= $form->field($settings, 'mail_port')->input('number'); ?>
                            <?= $form->field($settings, 'mail_user_name')->input('text'); ?>
                            <?= $form->field($settings, 'mail_user_pass')->input('text'); ?>
                            <?= $form
                                ->field($settings, "mail_encrypt_type")
                                ->dropDownList(Settings::getMailEncryptTypes(), ['class' => 'form-control']);
                            ?>
                            <?= $form->field($settings, 'admin_email')->input('email'); ?>
                            <?= $form->field($settings, 'currency')->input('text', ['value' => '₽']); ?>
                            <?= $form->field($settings, 'page_count_entries')->input('number', ['value' => 20]); ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab_4" role="tabpanel" aria-labelledby="tab_link_4">
                        <div class="overlay-wrapper">
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

                            <div class="form-group">
                                <label for="input_file">Логотип сайта</label>
                                <div class="input-group">
                                    <label class="btn bg-purple input-file">
                                        <text><span class="fa fa-cloud-upload"></span>&nbsp; Загрузить изображение</text>
                                        <?=Html::activeFileInput($files, 'image', ['class' => 'custom-file-input hidden']) ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->

            <div class="card-footer">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary float-right', 'name' => 'save']) ?>
            </div>
        </div>
        <?ActiveForm::end();?>
    </div>
</div>


