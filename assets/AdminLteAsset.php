<?php
namespace app\assets;

use yii\web\AssetBundle;

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';

    public $css = [
        'css/adminlte.min.css',
        '/css/admin/main.css',
        '/css/admin/AdminLTE_fonts.css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'
    ];

    public $js = [
        'js/adminlte.min.js',
        '/js/admin/main.js',
        '/assets/b7eb1763/control_sidebar.js'
    ];

    public $depends = [
        'hail812\adminlte3\assets\BaseAsset',
        'hail812\adminlte3\assets\PluginAsset'
    ];
}