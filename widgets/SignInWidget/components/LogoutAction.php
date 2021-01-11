<?php
namespace app\widgets\SignInWidget\components;

use yii\base\Action;
use Yii;

class LogoutAction extends Action
{
    public function run()
    {
        Yii::$app->user->logout();
        return $this->controller->goHome();
    }
}
?>