<?php
namespace app\widgets\SignInWidget\components;

use yii\base\Action;
use app\models\forms\LoginForm;
//use app\widgets\SignInWidget\SignInWidget;
use yii\helpers\Json;
use Yii;
use yii\web\Response;

class LoginAction extends Action
{
    public $view = '@app/views/site/login';
    public $layout;

    public function run()
    {
        $model = new LoginForm();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status'    => true,
                'header'    => 'Авторизация пользователя',
                'content'   => $this->controller->renderAjax('@app/widgets/SignInWidget/views/_content', [
                    'model' => $model,
                ]),
                'footer'    => $this->controller->renderAjax('@app/widgets/SignInWidget/views/_footer'),
            ];
        }

        if ($this->layout)
            $this->controller->layout = $this->layout;

        if (!Yii::$app->user->isGuest && $this->controller) {
            return $this->controller->goHome();
        }

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->controller->goBack();
        }
        return $this->controller->render($this->view, [
            'model' => $model,
        ]);
    }
}