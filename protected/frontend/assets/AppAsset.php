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
        'assets/css/site.css',
        'assets/css/bootstrap-tagsinput.css',
		    'assets/css/stylev3.css',
        'assets/css/flexslider.css',
        'assets/css/icomoon.css',
        'assets/css/animate.css',
        'assets/css/jquery-ui.min.css'
    ];
    public $js = [
		'assets/js/main.js',
		'assets/js/bootstrap-tagsinput.js',
		'assets/js/typehead.js',
		'assets/js/jquery-ui.min.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $publishOptions = [
    'forceCopy' => true,
    ];
}
