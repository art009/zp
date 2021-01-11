<?php
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class UrlifyAsset extends AssetBundle
{
    public $sourcePath = '@bower/urlify';
    public $js = [
        'urlify.min.js',
    ];
}
