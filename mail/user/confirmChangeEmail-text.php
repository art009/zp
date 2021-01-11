<?php

/* @var $this yii\web\View */
/* @var $user app\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/user/confirm-email', 'token' => $token->old_email_token]);
?>
Добрый день, <?= $user->username ?>,

Вы запросили восстановление пароля, для введение нового пароля перейдите по ссылке ниже:

<?= $confirmLink ?>

Если вы не запрашивали восстановление пароля на сате "<?=Yii::$app->name;?>", то просто проигнорируйте данное письмо.