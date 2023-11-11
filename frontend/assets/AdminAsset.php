<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin/css/fineuploader.css',
        'admin/css/imagemanager.css',
        'admin/css/site.css',
    ];
    public $js = [
        'admin/js/jquery-ui.min.js',
        'admin/js/fineuploader.js',
        'admin/js/imagemanager.js',
        'admin/js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
