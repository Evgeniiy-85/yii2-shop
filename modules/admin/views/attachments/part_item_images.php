<?use yii\helpers\Html;
use yii\jui\Sortable;?>

<div class="attach-action attach-delete">
    <span class="fa fa-remove"></span>
</div>

<div class="attach" href="#">
    <img src="<?=Yii::getAlias("/load/{$files->dir}/$image");?>">
</div>
<?=Html::activeInput('hidden', $files, 'files[]', ['value' => $image]);?>