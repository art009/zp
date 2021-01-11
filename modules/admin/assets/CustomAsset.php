<?php
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class CustomAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/web';
    public $css = [
        'css/style.css',
//        'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
    ];
    public $js = [
        'js/gallery.js',
        'js/script.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
	    'app\modules\admin\assets\AdminLteAsset',
	    'app\modules\admin\assets\DateRangeAsset',
    ];
}
