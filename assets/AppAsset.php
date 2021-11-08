<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;
use rmrevin\yii\fontawesome\AssetBundle as FontawesomeAssetBundle;
use app\assets\BootstrapAsset;
use app\assets\FancyBoxAsset;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $jsOptions = ['position' => View::POS_END];

    public $css = [
        'css/style.css',
    ];

    public $js = [
        'js/script.js'
    ];

    public $depends = [
	    FontawesomeAssetBundle::class,
        BootstrapAsset::class,
        FancyBoxAsset::class,
    ];
}
