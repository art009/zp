<?php
namespace app\widgets\GoogleReCaptcha\assets;

use yii\web\AssetBundle;
use Yii;
use yii\base\InvalidConfigException;

class ReCaptchaAsset extends AssetBundle{

    const API_JS = 'https://www.google.com/recaptcha/api.js';

    public function init(){
        $params = Yii::$app->params['reCaptcha'];
        if (empty($params) || !isset($params['siteKey'])){
            throw new InvalidConfigException('Required `siteKey` param isn\'t set.');
        }
        $arguments = http_build_query([
            'render' => $params['siteKey'],
            'onload' => 'recaptchaOnloadCallback',
        ]);
        $this->js[] = self::API_JS . '?' . $arguments;
        parent::init();
    }

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}