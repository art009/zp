<?php
namespace app\components;

use yii\web\Controller;
use Yii;

class MainController extends Controller
{
    public $layout = '@app/views/layouts/main';

    public function goBack($defaultUrl = null)
    {
        if(Yii::$app->user->returnUrl != '/') {
            return parent::goBack($defaultUrl);
        } else {
            return Yii::$app->request->referrer ? $this->redirect(Yii::$app->request->referrer) : $this->goHome();
        }

    }
}