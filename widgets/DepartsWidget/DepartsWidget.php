<?php
namespace app\widgets\DepartsWidget;

use app\models\Depart;
use yii\base\Widget;
use Yii;
use app\widgets\DepartsWidget\assets\DepartsAssets;

class DepartsWidget extends Widget
{
	public function run()
	{
		$departs = Depart::find()->where(['is_main' => 0])->all();
		if ($departs) {
			$view = $this->getView();
			DepartsAssets::register($view);
			return $this->render('index',[
				'departs' => $departs,
			]);
		}


	}

	public function init()
	{
		return parent::init();
	}
}