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
                'dist/css/main.css',
            ];
            $this->js = [
                'js/jquery-ui.min.js',
                'dist/js/custom.js',
            ];
        }
        else if(YII_ENV_PROD) {
            $this->css = [
                'css/jquery-ui.min.css',
                'dist/css-min/main.min.css',
            ];
            $this->js = [
                'js/jquery-ui.min.js',
                'dist/js-min/custom.min.js',
            ];
        }

        parent::init();
    }
}
