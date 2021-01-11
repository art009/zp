<?php

namespace app\widgets\ContactWidget\components;

use app\widgets\ContactWidget\ContactWidget;
use Yii;
use yii\base\Action;
use app\widgets\ContactWidget\models\ContactForm;
use app\helpers\Pages as PagesHelper;
use yii\web\Response;
use yii\helpers\Html;

class MailAction extends Action
{
    public $layout;

    public function run($person = NULL, $goal = NULL)
    {
        $model = new ContactForm();

        if (Yii::$app->request->isAjax) {
            $status = false;
            if (Yii::$app->request->post()) {
                $model->load(Yii::$app->request->post());
                if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['contact-mail'])) {
                    $status = true;
                    $message = '<div class="alert alert-success">Ваш сообщение успешно отправлено. В ближайшее время с вами свяжется наш менджер.</div>';
                }

                if ($model->hasErrors()) {
	                $message = Html::errorSummary($model,[
	                	'header' => false,
		                'class' => 'alert alert-danger'
	                ]);
                }

                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'status' => $status,
                    'header' => 'Статус сообщения',
                    'message' => $message,
                ];
            }

            return ContactWidget::widget(['person' => $person, 'goal' => $goal]);
        }

        return $this->controller->redirect(PagesHelper::getUrlByLayout(PagesHelper::LAYOUT_CONTACT));

    }
}