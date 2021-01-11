<?php
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class SortableAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-sortable/source/js';
    public $js = [
        'jquery-sortable-min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
