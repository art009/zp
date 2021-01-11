<?php

namespace app\components;

use app\models\Depart;
use yii\base\BootstrapInterface;
use yii\base\Application;
use Yii;

class DepartBootstrapClass implements BootstrapInterface
{
	public function bootstrap($app)
	{
		$app->on(Application::EVENT_BEFORE_REQUEST, function () {
			$path_info = Yii::$app->request->pathInfo;
			$path = explode('/', $path_info );
			if (isset ($path[0]) ) {
				$depart = Depart::findOne( ['slug' => $path[0]] );
				if (!$depart) {
					$depart = Depart::defaultDepart();
				}
			}
			Yii::$app->params['depart'] = $depart->id;
			Yii::$app->params['depart_slug'] = $depart->slug;
		});
	}
}