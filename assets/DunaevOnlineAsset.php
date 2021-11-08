<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;
use app\assets\FontAwesomeAsset;
use app\assets\BootstrapAsset;
use app\assets\SlickAsset;
use app\assets\FancyBoxAsset;
use app\assets\BviAsset;

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
		FontAwesomeAsset::class,
		BootstrapAsset::class,
		SlickAsset::class,
		FancyBoxAsset::class,
		BviAsset::class,
	];
}
