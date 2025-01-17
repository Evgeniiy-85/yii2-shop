<?php

namespace app\assets;

use yii\web\AssetBundle;

class Almasaeed2010Asset extends AssetBundle {
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $css = [
        'fontawesome-free/css/fontawesome.min.css',
        'fontawesome-free/css/v4-shims.css',
    ];

    public $js = [
//        'bs-custom-file-input/bs-custom-file-input.js',
//        'bs-custom-file-input/bs-custom-file-input.min.js'
    ];

    public $publishOptions = [
        'only' => [
            'fonts/*',
            'css/*',
        ]
    ];
}