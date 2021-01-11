<?php
namespace app\widgets\OrderUserWidget\components;

use yii\helpers\Html;
use yii\base\Action;
use app\models\forms\OrderForm;
use Yii;

class OrderAction extends Action
{
//    public $view = '@app/views/site/login';
//    public $layout;

    public function run()
    {
        $model = new OrderForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->issueOrder()) {
                Yii::$app->session->setFlash('success','Ваш заказ успешно оформлен.');

                if (Yii::$app->user->isGuest)
                    return $this->controller->goHome();
                else
                    return $this->controller->redirect('/lk/index');
            }
        } else {
            if ($model->hasErrors())
                Yii::$app->session->setFlash('danger',Html::errorSummary($model,['header' => false]));
            else
                Yii::$app->session->setFlash('danger','Нет информации для оформления заказа.');
        }

        return $this->controller->redirect('/cart/index');
    }
}