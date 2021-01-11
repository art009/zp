<?php

namespace app\widgets\ModalWindowWidget\actions;

use app\models\ModalWindow;
use Yii;
use yii\base\Action;
use yii\web\Response;

class ContentWindowAction extends Action
{
	public function run($id)
	{
		$modal_window = ModalWindow::findOne($id);
		$result = [
			'status' => false
		];
		if ( $modal_window ) {
			$result = [
				'status' => true,
				'title' => $modal_window->title,
				'content' => $modal_window->content,
			];
		}

		Yii::$app->response->format = Response::FORMAT_JSON;
		return $result;
	}
}