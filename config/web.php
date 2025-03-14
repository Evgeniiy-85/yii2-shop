<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'defaultRoute' => 'products/index',
    'components' => [
        'request' => [
            'cookieValidationKey' => '2P8R7szlWv_lN7mgDMFRnS7hfLcharV5',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [ // переопределение контроллеров для страниц
                '/' => 'categories',
                '/admin' => 'admin/admin',
                '/catalog' => 'categories',
                '/search' => 'products/search',
                '/products/<alias:>' => 'products/product',
                '/categories/<alias:>' => 'categories/category',
                '/categories/<parent_cat_alias:>/<alias:>' => 'categories/category',
                '/buy/<alias:>' => 'order/buy',
                '/pay/<ID:\d+>' => 'order/pay',
                '/pay/success' => 'order/success',
                '/login' => 'site/login',

                '/admin/products/<ID:\d+>' => 'admin/products/edit',
                '/admin/products/delete/<ID:\d+>' => 'admin/products/delete',
                '/admin/users/<ID:\d+>' => 'admin/users/edit',
                '/admin/categories/<ID:\d+>' => 'admin/categories/edit',
                '/admin/categories/delete/<ID:\d+>' => 'admin/categories/delete',
                '/admin/settings/payments' => 'admin/payments/index',
                '/admin/settings/payments/<ID:\d+>' => 'admin/payments/edit',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
    ],
    'params' => $params,
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'main'
        ],
    ]
];


foreach (scandir(__DIR__.'/../modules/payments') as $payment_name) {
    if ($payment_name !== '.' && $payment_name !== '..') {
        $config = array_merge_recursive(
            $config, require(__DIR__."/../modules/payments/{$payment_name}/config.php")
        );
    }
}

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ // here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ // setting for our templates
                    'yii2-adminlte3' => '@vendor/hail812/yii2-adminlte3/src/gii/generators/crud/default' // template name => path to template
                ]
            ]
        ]
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
