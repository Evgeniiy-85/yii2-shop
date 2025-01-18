<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii;
use yii\web\View;

class AdminLoginAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/admin/main.css',
        'css/admin/ionicons.min.css',
    ];

    public $js = [

    ];

    public $depends = [
        'hail812\adminlte3\assets\PluginAsset',
        'hail812\adminlte3\assets\AdminLteAsset',
    ];

    public function registerAssetFiles($view) {
        parent::registerAssetFiles($view);
    }
}
