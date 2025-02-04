<?use yii\helpers\Html;
use yii\jui\Sortable;?>

<a class="attach" href="#">
    <img src="<?=Yii::getAlias("/load/{$files->dir}/$image");?>">
</a>
<?=Html::activeInput('hidden', $files, 'files[]', ['value' => $image]);?>