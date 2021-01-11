<?php

namespace app\widgets\SpecialAsset;
use yii\web\AssetBundle;
use yii\web\View;

class SpecialAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';


	public $jsOptions = ['position' => View::POS_END];

	public $css = [
		//'eye/vi.css',
	];
	public $js = [
		'js/eye/special.js?v=0.01',
	];
}