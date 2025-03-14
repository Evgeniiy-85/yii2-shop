<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';
$application = new yii\web\Application($config);

if ('dev' == YII_ENV) {
    (new \app\components\SassPreprocessor())->run('@webroot/sass', '@webroot/css/style.css', [
        'main', 'products', 'product-card', 'categories', 'cart-modal', 'header', 'product-reviews'
    ]);
}

$application->run();