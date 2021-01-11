<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\Alert;
/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?= Alert::widget() ?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($user, '_password')->passwordInput(['maxlength' => 255]) ?>
<div class="form-group">
    <?= Html::button('Сменить пароль', [
        'class' => 'btn btn-success btn-flat',
        'onclick' => 'saveNewPassword(this)',
        ]) ?>
    <?= Html::button('Закрыть', [
        'class' => 'btn btn-default btn-flat',
        'onclick' => 'closeModal(this)',
    ]) ?>
</div>
<?php ActiveForm::end(); ?>
