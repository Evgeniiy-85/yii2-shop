<?use yii\helpers\Html;
use app\modules\admin\models\Files;?>

<div class="attach-action attach-delete">
    <span class="fa fa-remove"></span>
</div>

<div class="attach">
    <img src="<?=Files::getRelativePath($type, $image);?>">
</div>
<?=Html::activeInput('hidden', $files, 'files[]', ['value' => $image]);?>