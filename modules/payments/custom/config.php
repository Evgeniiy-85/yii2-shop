<?php

$config = [
    'components' => [
        'urlManager' => [
            'rules' => [
                '/admin/settings/payments/custom' => 'payment_custom/admin/index',
                '/payments/custom' => 'payment_custom/payment/index',
                '/payments/custom/pay/<order_id:\d+>' => 'payment_custom/payment/pay',
                '/pay/custom/success' => 'payment_custom/payment/success',
            ],
        ],
    ],
    'modules' => [
        'payment_custom' => [
            'class' => 'app\modules\payments\custom\Module',
        ],
    ]
];

return $config;
