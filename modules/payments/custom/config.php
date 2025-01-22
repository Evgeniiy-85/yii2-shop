<?php

$config = [
    'components' => [
        'urlManager' => [
            'rules' => [
                '/admin/settings/payments/custom' => 'payment_custom/admin/index',
                '/payments/custom' => 'payment_custom/payment/index',
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
