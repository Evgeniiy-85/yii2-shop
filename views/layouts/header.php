<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;

!$is_hidden = Yii::$app->request->getPathInfo() == 'cart/checkout';?>

<header>
    <div class="header-top">
        <nav id="w0" class="navbar navbar-expand-md navbar-white bg-white fixed-top">
            <div class="container">
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
            </div>
        </nav>
    </div>

    <div class="header-bottom bg-white">
        <div class="container">
            <div class="header-left">
                <div class="logo-wrap">
                    <img src="/images/icons/logo.svg">
                </div>

                <?if($this->context->isShowHeaderMenu()):?>
                    <div class="catalog-menu-wrap">
                        <a href="/catalog" class="catalog-menu">Каталог</a>
                    </div>
                <?endif;?>
            </div>

            <?if($this->context->isShowHeaderMenu()):?>
                <div class="header-center">
                    <div class="search">
                        <div class="search-wrap">
                            <?=Html::beginForm(['/search'], 'get', ['id' => 'form-search']) ?>
                            <div class="input-group">
                                <?=Html::input('text', 'q', urldecode((string)Yii::$app->request->get('q')), ['placeholder' => 'Поиск по сайту']);?>
                                <?=Html::submitButton('',['class' => 'btn-search']);?>
                            </div>
                            <?=Html::endForm();?>
                        </div>
                    </div>
                </div>
            <?endif;?>

            <div class="header-right">
                <div class="header-buttons">
                    <?if($this->context->isShowHeaderMenu()):?>
                        <div class="btn-wrap">
                            <a href="<?=Url::to(['/favorites']);?>" class="btn-favourites">
                                <i class="btn-icon"></i>
                                <span class="btn-title">Избранное</span>
                            </a>
                        </div>

                        <div class="btn-wrap">
                            <a href="<?=Url::to(['/cart']);?>" class="btn-cart">
                                <i class="btn-icon"></i>
                                <i class="count-products-icon hidden"></i>
                                <span class="btn-title">
                                    <span>Корзина</span>
                                </span>
                            </a>
                            <?=$this->render('//products/cart_modal');?>
                        </div>
                    <?endif;?>

                    <div class="btn-wrap">
                        <a href="" class="btn-login">
                            <i class="btn-icon"></i>
                            <span class="btn-title">Войти</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>