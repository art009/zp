<?php
namespace app\assets;

use yii\web\AssetBundle;

class FancyBoxAsset extends AssetBundle{

    public $sourcePath = '@bower/fancybox/dist';

    public function init(){
        $this->js[] = YII_DEBUG ? 'jquery.fancybox.js' : 'jquery.fancybox.min.js';
        $this->css[] = YII_DEBUG ? 'jquery.fancybox.css' : 'jquery.fancybox.min.css';
        parent::init();
    }

    public $depends =[
        'yii\web\JqueryAsset'
    ];
}