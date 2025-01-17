<?php

namespace app\assets;

use yii\web\AssetBundle;

class Almasaeed2010Asset extends AssetBundle {
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/fontawesome-free';
    public $css = [
        'css/fontawesome.min.css',
        'css/v4-shims.css',
    ];
    public $publishOptions = [
        'only' => [
            'fonts/*',
            'css/*',
        ]
    ];
}