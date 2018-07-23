<?php

/**
 * Created by Vladimir Hryvinskyy.
 * Site: http://codice.in.ua/
 * Date: 01.06.2016
 * Project: oakcms
 * File name: Asset.php
 */
namespace oakcms\bootstrapswitch;

use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-switch/dist';

    public $css = [
        'css/bootstrap3/bootstrap-switch.css'
    ];
    
    public $js = [
        'js/bootstrap-switch.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
