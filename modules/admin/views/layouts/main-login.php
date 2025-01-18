<?php

use app\assets\AdminLoginAsset;
use yii\helpers\Html;
use hail812\adminlte3\assets\AdminLteAsset;

AdminLoginAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Html::encode($this->title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>

<body class="hold-transition login-page">
    <?php  $this->beginBody() ?>
    <div class="login-box">
        <?= $content ?>
    </div>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>