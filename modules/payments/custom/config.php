<?php

$config = [
    'components' => [
        'urlManager' => [
            'rules' => [
                '/admin/settings/payments/custom' => 'payment_custom/admin/index',
                '/payments/custom' => 'payment_custom/payment/index',
                '/payments/custom/pay/<order_id:\d+>' => 'payment_custom/payment/pay',
            ],
        ],
    ],
    'modules' => [
        'payment_custom' => [
            'class' => 'app\modules\payments\custom\Module',
            'layout' => '@app/modules/admin/views/layouts/main'
        ],
    ]
];

return $config;
