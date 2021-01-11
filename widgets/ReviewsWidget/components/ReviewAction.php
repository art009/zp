<?php
namespace app\widgets\ReviewsWidget\components;

use app\models\Depart;
use yii\helpers\Html;
use yii\base\Action;
use app\models\Reviews;
use Yii;
use yii\web\Response;

class ReviewAction extends Action
{
    public function run()
    {
        $model = new Reviews();
        $status = false;

        $model->status = Reviews::STATUS_NEW;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	if ($model->depart) {
        		$depart = Depart::findOne( $model->depart );
	        } else {
		        $depart = Depart::defaultDepart();
	        }
	        $list_mails = Yii::$app->params['contact-mail'];
        	if ( $depart->mails )
	            $list_mails = $depart->mails;
	        $model->contact($list_mails);

            $status = true;
            $message = '<div class="alert alert-success">Ваше сообщение отправлено менеджеру.</div>';
        }

        if ($model->hasErrors()) {
            $message = Html::errorSummary($model);
        }

        if (Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => $status,
                'header' => 'Статус сообщения',
                'message' => $message,
            ];
        } else {
            return $this->controller->goBack();
        }
    }
}