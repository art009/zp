<?php

namespace app\widgets\PriceWidget;

use app\models\Pages;
use Yii;

class PriceWidget extends \yii\base\Widget
{
	public $page;

	public function run()
	{
		$page = Pages::findOne($this->page);
		if ($page->price) {

			return $this->render('index', [
				'prices' => $page->price,
			]);
		}

		return null;
	}

	public function init()
	{
		return parent::init();
	}
}