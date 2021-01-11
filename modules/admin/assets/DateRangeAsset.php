<?php
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class DateRangeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/bower_components';
    public $css = [
        'bootstrap-daterangepicker/daterangepicker.css',
    ];
    public $js = [
        'bootstrap-daterangepicker/daterangepicker.js',
    ];
    public $depends = [
        'app\modules\admin\assets\MomentAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
