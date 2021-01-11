<?php

namespace app\widgets\DepartsWidget\assets;

use yii\web\AssetBundle;
use yii\web\View;

class DepartsAssets extends AssetBundle
{
	public $sourcePath = '@app/widgets/DepartsWidget/dist';

	public $jsOptions = ['position' => View::POS_END];

	public $css = [
		'css/style.css',
	];

	public $js = [];

	public $depends = [
//		'yii\web\JqueryAsset',
	];
}