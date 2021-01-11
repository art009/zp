<?php
/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/user/reset-password', 'token' => $token->token]);
?>
Добрый день, <?= $user->username ?>,

Вы запросили восстановление пароля, для введение нового пароля перейдите по ссылке ниже:

<?= $resetLink ?>

Если вы не запрашивали восстановление пароля на сате "<?=Yii::$app->name;?>", то просто проигнорируйте данное письмо.