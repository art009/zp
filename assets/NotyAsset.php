<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class NotyAsset extends AssetBundle{

    public $sourcePath = '@bower/noty/js/noty/packaged';

    public function init(){
        $this->js[] = YII_DEBUG ? 'jquery.noty.packaged.js' : 'jquery.noty.packaged.min.js';
        parent::init();
    }

    public $depends =[
	    JqueryAsset::class
    ];
}