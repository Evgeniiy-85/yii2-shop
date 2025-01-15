<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\bootstrap4\Html;
use app\assets\AdminLtePluginAsset;

AdminLtePluginAsset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?=Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?=Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="<?= \dmstr\helpers\AdminLteHelper::skinClass();?>">
<?php $this->beginBody() ?>

<div class="wrapper">
    <?=$this->render(
        'header.php',
        ['directoryAsset' => $directoryAsset]
    )?>

    <?=$this->render(
        'left.php',
        ['directoryAsset' => $directoryAsset]
    )?>

    <?=$this->render(
        'content.php',
        ['content' => $content, 'directoryAsset' => $directoryAsset]
    )?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
