<?php
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class FancyBoxAsset extends AssetBundle
{
    public $sourcePath = '@bower/fancybox/source/';
    public $css = [
        'jquery.fancybox.css?v=2.1.5',
    ];
    public $js = [
        'jquery.fancybox.pack.js?v=2.1.5',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
