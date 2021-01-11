<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['/site/confirm-email', 'token' => $token->new_email_token]);
?>
<div class="password-reset">
    <p>Добрый день, <?= Html::encode($user->username) ?>,</p>

    <p>Спасибо за регистрацию на сайте "<?=Html::a(Yii::$app->name,Yii::$app->homeUrl);?>". Для подтверждения эл. почты перейдите по ссылки:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>

    <p>Если вы не регистрировались на сате "<?=Html::a(Yii::$app->name,Yii::$app->homeUrl);?>", то просто проигнорируйте данное письмо.</p>
</div>
