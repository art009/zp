<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DunaevOnlineAsset extends AssetBundle
{
//	public $sourcePath = '@app/templates/dunaev.online/build';
	public $basePath = '@webroot';
	public $baseUrl = '@web';

	public $jsOptions = ['position' => View::POS_END];

	public $css = [
		'css/style.min.css',
		'css/custom.css',
	];

	public $js = [
		'js/doT.js',
		'js/main.min.js',
//		'js/eye/special.js',
	];

	public $depends = [
		'app\assets\FontAwesomeAsset',
		'app\assets\BootstrapAsset',
		'app\assets\SlickAsset',
		'app\assets\FancyBoxAsset',
		'app\assets\BviAsset',
//        'app\assets\NotyAsset',
//        'app\assets\AnimateAsset',
//        'yii\widgets\MaskedInputAsset',
	];
}
