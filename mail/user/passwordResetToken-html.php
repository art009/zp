<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/user/reset-password', 'token' => $token->token]);
?>
<div class="password-reset">
    <p>Добрый день, <?= $user->username ?>,</p>

    <p>Вы запросили восстановление пароля, для введение нового пароля перейдите по ссылке ниже:<br/>

    <?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

    <p>Если вы не запрашивали восстановление пароля на сате "<?=Yii::$app->name;?>", то просто проигнорируйте данное письмо.</p>


</div>
