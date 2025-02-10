<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii;
use yii\web\View;

class AdminAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/admin/main.css',
        //'css/adminlte.min.css',
    ];

    public $js = [
        'js/admin/main.js',
        'js/admin/attachments.js',
        'js/admin/Chart.min.js',
    ];

    public $depends = [
        'hail812\adminlte3\assets\BaseAsset',
        'hail812\adminlte3\assets\PluginAsset',
        'hail812\adminlte3\assets\AdminLteAsset',
        'hail812\adminlte3\assets\FontAwesomeAsset',
        'app\assets\Almasaeed2010Asset',
        'yii\web\YiiAsset',
    ];

    public function registerAssetFiles($view) {
        parent::registerAssetFiles($view);

        $publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
        $view->registerJsFile("{$publishedRes[1]}/control_sidebar.js");
    }
}
