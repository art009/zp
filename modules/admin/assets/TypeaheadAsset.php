<?php
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class TypeaheadAsset extends AssetBundle
{
    public $sourcePath = '@bower/typeahead.js/dist';
    public $css = [

    ];
    public $js = [
        'typeahead.jquery.min.js',
//        'typeahead.bundle.min.js',
        'bloodhound.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
