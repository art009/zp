<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

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
	    JqueryAsset::class,
    ];
}