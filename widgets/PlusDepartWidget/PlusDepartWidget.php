<?php

namespace app\widgets\PlusDepartWidget;

use app\models\Pages;
use app\models\PlusDepart;
use Yii;

class PlusDepartWidget extends \yii\base\Widget
{
	public $depart_id = NULL;

	public function run()
	{
		$services = PlusDepart::find()
			->where([
				'depart_id' => $this->depart_id
			])
			->all();

		if ($services) {
			return $this->render('index', [
				'services' => $services,
			]);
		}

		return null;
	}

	public function init()
	{
		return parent::init();
	}
}