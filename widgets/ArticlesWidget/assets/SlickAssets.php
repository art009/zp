<?php
namespace app\widgets\ArticlesWidget\assets;

use yii\web\AssetBundle;

class SlickAssets  extends AssetBundle
{
	public $sourcePath = '@bower/slick-carousel/slick';

	public $js = [
		'slick.min.js',
	];

	public $depends = [
		'yii\web\JqueryAsset',
	];
}