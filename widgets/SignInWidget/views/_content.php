<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use budyaga\users\components\AuthChoice;

?>

<?php if(Yii::$app->authClientCollection->clients):?>
    <p>Вы можете авторизоваться через социальную сеть:</p>
    <p>
        <?= AuthChoice::widget([
            'baseAuthUrl' => ['/user/auth/index']
        ]) ?>
    </p>
    <p>или зайти по логину и паролю</p>
<?php endif;?>

<?php $form = ActiveForm::begin(['id' => 'login-widget-form', 'action' => Url::toRoute('/login')]); ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'rememberMe')->checkbox() ?>
<div class="text-center">
    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    <?php // Html::button('Закрыть', ['class' => 'btn btn-default', 'onclick' => 'closeModal(this)']) ?>
</div>
<?php ActiveForm::end(); ?>
