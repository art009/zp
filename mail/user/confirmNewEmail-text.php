<?php

/* @var $this yii\web\View */
/* @var $user app\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['/site/confirm-email', 'token' => $token->new_email_token]);
?>
Добрый день, <?= $user->username ?>,

Спасибо за регистрацию на сайте "<?=Yii::$app->name;?>". Для подтверждения эл. почты перейдите по ссылки:

<?= $confirmLink ?>

Если вы не регистрировались на сате "<?=Yii::$app->name;?>", то просто проигнорируйте данное письмо.
