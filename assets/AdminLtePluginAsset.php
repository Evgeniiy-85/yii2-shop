<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminLtePluginAsset extends AssetBundle
{
    public $publishedRes;

    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';
    public $js = [
        '/js/admin/main.js',
    ];
    public $css = [
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback)',
        '/css/admin/main.css',
    ];
    public $depends = [
        '\hail812\adminlte3\assets\AdminLteAsset'
    ];
}
