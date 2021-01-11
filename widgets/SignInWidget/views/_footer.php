<?php
use yii\helpers\Url;
?>

<a href="<?= Url::toRoute('/site/signup')?>">Регистрация</a><br>
<a href="<?= Url::toRoute('/user/user/request-password-reset')?>">Сброс пароля</a>