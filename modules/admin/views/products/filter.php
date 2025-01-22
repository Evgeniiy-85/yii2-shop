<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Product;
use app\models\Category;

$categories = Category::find()
    ->select(['cat_title'])
    ->where([
        'cat_status' => Category::STATUS_ACTIVE,
    ])
    ->indexBy('cat_id')
    ->column();
?>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Фильтр</h3>
    </div>

    <?$form = ActiveForm::begin([
        'id' => 'form-products',
        'action' => "/admin/{$this->context->id}",
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]);?>

    <div class="card-body">
        <?= $form->field($filter, 'prod_title')->input('text'); ?>
        <?= $form
            ->field($filter, "prod_category")
            ->dropDownList($categories, ['class' => 'form-control', 'prompt' => '-']);
        ?>
        <?= $form->field($filter, 'prod_article')->input('text'); ?>
        <?= $form
            ->field($filter, "prod_status")
            ->dropDownList(Product::getStatuses(), ['class' => 'form-control', 'prompt' => '-']);
        ?>
    </div>

    <div class="card-footer text-right">
        <div class="margin">
            <?if($filter->is_filter):?>
                <div class="btn-group">
                    <a class="btn btn-default" href="/admin/products?reset_filter=1">
                        <span class="fa fa-close"></span> Сбросить
                    </a>
                </div>
            <?endif;?>

            <div class="btn-group">
                <?= Html::submitButton('Применить', ['class' => 'btn btn-primary', 'name' => 'apply']) ?>
            </div>
        </div>

    </div>
    <?ActiveForm::end();?>
</div>