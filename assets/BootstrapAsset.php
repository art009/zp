<?php

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap4/dist';
    public $css = [
        'css/bootstrap.min.css',
    ];
    public $js = [
        'js/bootstrap.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}