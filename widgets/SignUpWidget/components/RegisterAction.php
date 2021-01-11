<?php

namespace app\widgets\SignUpWidget\components;

use yii\base\Action;
use app\widgets\SignUpWidget\models\SignupForm;
use Yii;
use yii\helpers\Url;

class RegisterAction extends Action
{
    public function run()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            if ($user = $model->signup()) {
                if ($user->createEmailConfirmToken() && $user->sendEmailConfirmationMail('@app/mail/user/confirmNewEmail', 'new_email')) {
                    Yii::$app->getSession()->setFlash('success', 'Пользователь успешно зарегистрирован. Инструкция выслана на эл. почту.');
                    $transaction->commit();
                    return $this->controller->redirect(Url::toRoute('/site/login'));
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Не удалось выслать подтверждение на почтовый ящик. Свяжитесь с администратором сайта.');
                    $transaction->rollBack();
                };
            }
            else {
                Yii::$app->getSession()->setFlash('error', 'Новый пользователь не зарегистрирован!');
                $transaction->rollBack();
            }
        }

        return $this->controller->render('@app/widgets/SignUpWidget/views/index',['model' => $model]);
    }
}