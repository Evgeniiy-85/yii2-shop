<?php

$config = [
    'components' => [
        'urlManager' => [
            'rules' => [
                '/admin/settings/payments/tinkoff' => 'payment_tinkoff/admin/index',
                '/payments/tinkoff' => 'payment_tinkoff/payment/index',
            ],
        ],
    ],
    'modules' => [
        'payment_tinkoff' => [
            'class' => 'app\modules\payments\tinkoff\Module',
            'layout' => '@app/modules/admin/views/layouts/main'
        ],
    ]
];

return $config;
