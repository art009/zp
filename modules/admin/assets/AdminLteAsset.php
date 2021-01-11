<?php
namespace app\modules\admin\assets;

use yii\web\AssetBundle;
use dmstr\web\AdminLteAsset as MainAdminLteAsset;

class AdminLteAsset extends MainAdminLteAsset
{
	public $depends = [
		'app\assets\FontAwesomeAsset',
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
	];
}
