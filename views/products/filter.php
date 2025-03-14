<?php use yii\widgets\ActiveForm;
use yii\helpers\Html;?>

<?$form = ActiveForm::begin([
    'id' => 'form-products_filter',
    'action' => false,
    'method' => 'GET',
    'options' => [
        'enctype' => 'multipart/form-data',
    ]
]);?>

<div class="products-filter">
    <div class="filter-item">
        <div class="filter-group_wrap">
            <div class="filter-name">Цена</div>
            <div class="filter-group">
                <?= $form->field($filter, 'min_price', ['template' => '{input}'])->input('text', ['placeholder' => $filter->getAttributeLabel('min_price')]); ?>
                <?= $form->field($filter, 'max_price', ['template' => '{input}'])->input('text', ['placeholder' => $filter->getAttributeLabel('max_price')]); ?>
            </div>
        </div>
    </div>

    <div class="filter-item">
        <div class="btn-group">
            <?= Html::submitButton('Применить', ['class' => 'button button-ui btn_a-primary', 'name' => 'filter', 'value' => 'apply']) ?>
        </div>

        <?if($filter->is_filter):?>
            <div class="btn-group">
                <?= Html::submitButton('Сбросить', ['class' => 'button button-ui btn_a-secondary', 'name' => 'filter', 'value' => 'reset']) ?>
            </div>
        <?endif;?>
    </div>
</div>

<?ActiveForm::end();?>