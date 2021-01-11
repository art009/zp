<?php
/*
 * Login form
 *
 * */

namespace app\widgets\SignInWidget;

use budyaga\users\models\forms\LoginForm;
use \Yii;
use yii\base\Widget;
use yii\web\Response;

class SignInWidget extends Widget
{
    public $is_ajax = false;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = new LoginForm;
        if ($this->is_ajax) {
            //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return  [
                'status'    => true,
                'header'    => 'Авторизация пользователя',
                'content'   => $this->render('_content', ['model' => $model]),
            ];
        }

        return $this->render('index', ['model' => $model]);
    }
}