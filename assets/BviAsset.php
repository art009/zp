<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;
use yii\web\JqueryAsset;

class BviAsset extends AssetBundle
{
	public $sourcePath = '@vendor/veks/button-visually-impaired-javascript/dist';

	public $jsOptions = ['position' => View::POS_END];

	public $css = [
		'css/bvi.min.css',
	];

	public $js = [
		'js/js.cookie.js',
		'js/bvi-init.js',
		'js/bvi.min.js',
	];

	public $depends = [
		JqueryAsset::class,
	];
}