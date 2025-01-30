<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>


<header>
    <nav id="w0" class="navbar navbar-expand-md navbar-white bg-white fixed-top">
        <div class="container">
            <div class="header-left"></div>
            <div class="header-center">

            <div id="w0-collapse" class="collapse navbar-collapse">
                <ul id="w1" class="navbar-nav nav">
                    <li class="nav-item">
                          <a href="#">&nbsp</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">&nbsp</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="header-bottom bg-white">
        <div class="container">
            <div class="header-left"></div>
            <div class="header-center">
                <div class="search">
                    <div class="search-wrap">
                        <?=Html::beginForm(['/search'], 'get', ['id' => 'form-search']) ?>
                        <div class="input-group">
                            <?=Html::input('text', 'q', urldecode( Yii::$app->request->get('q')), ['placeholder' => 'Поиск по сайту']);?>
                            <?=Html::submitButton('',['class' => 'btn-search']);?>
                        </div>
                        <?=Html::endForm();?>
                    </div>
                </div>
            </div>

            <div class="header-right">
                <div class="header-buttons">
                    <div class="btn-wrap">
                        <a href="" class="btn-favourites">
                            <i class="btn-icon"></i>
                            <span>Избранное</span>
                        </a>
                    </div>

                    <div class="btn-wrap">
                        <a href="" class="btn-cart">
                            <i class="btn-icon"></i>
                            <b>2699</b>
                        </a>
                        <?=$this->render('/products/cart_modal');?>
                    </div>

                    <div class="btn-wrap">
                        <a href="" class="btn-login">
                            <i class="btn-icon"></i>
                            <span>Войти</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'label' => 'Каталог',
                'url' => '/catalog',
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; My Company <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
