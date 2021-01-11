<?php
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class MomentAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/bower_components/moment';
    public $css = [

    ];
    public $js = [
        'min/moment.min.js',
    ];
}
