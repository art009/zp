<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class SlickAsset extends AssetBundle
{
    public $sourcePath = '@bower/slick-carousel/slick';
    public $css = [
        'slick.css',
        'slick-theme.css',
    ];
    public $js = [
        'slick.min.js',
    ];
    public $depends = [
    	JqueryAsset::class,
    ];
}