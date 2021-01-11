<?php
namespace app\widgets\SliderWidget\assets;

use yii\web\AssetBundle;

class CounterupAssets extends AssetBundle
{
    public $sourcePath = '@bower/countUp.js';

    public $js = [
        'countUp.js',
    ];
}