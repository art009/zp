<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/user/confirm-email', 'token' => $token->old_email_token]);
?>
<div class="password-reset">
    <p>Добрый день, <?= Html::encode($user->username) ?>,</p>

    <p>Вы запросили восстановление пароля, для введение нового пароля перейдите по ссылке ниже:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>

    <p>Если вы не запрашивали восстановление пароля на сате "<?=Html::a(Yii::$app->name,Yii::$app->homeUrl);?>", то просто проигнорируйте данное письмо.</p>
</div>
