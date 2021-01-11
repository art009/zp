<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

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
        'css/style.css?v=002',
    ];

    public $js = [
        'js/script.js?v=002'
    ];

    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'app\assets\BootstrapAsset',
//        'app\assets\SlickAsset',
        'app\assets\FancyBoxAsset',
//        'app\assets\NotyAsset',
//        'app\assets\AnimateAsset',
//        'yii\widgets\MaskedInputAsset',
    ];
}
