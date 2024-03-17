<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery-ui.min.css',
        'css/site.css',
    ];
    /*public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];*/
    public $depends = [
        'yii\web\JqueryAsset',
        // 'yii\web\YiiAsset',
        /*'yii\bootstrap\BootstrapAsset',*/
    ];

    public function init()
    {
        if (YII_ENV_DEV)
        {
            $this->css = [
                'css/jquery-ui.min.css',
                'public/dist/css/talwind.css',
                'public/dist/css/main.css',
//                'dist/css/main.css',
            ];
            $this->js = [
                'js/jquery-ui.min.js',
//                'dist/js/custom.js',
                'public/dist/js/manifest.js',
                'public/dist/js/vendor.js',
                'public/dist/js/main.js',
            ];
        }
        else if(YII_ENV_PROD) {
            $this->css = [
                'css/jquery-ui.min.css',
                'public/dist/css/talwind.css',
                'public/dist/css/main.css',
//                'dist/css-min/main.min.css',
            ];
            $this->js = [
                'js/jquery-ui.min.js',
//                'dist/js/custom.js',
                'public/dist/js/manifest.js',
                'public/dist/js/vendor.js',
                'public/dist/js/main.js',
            ];
        }

        parent::init();
    }
}
