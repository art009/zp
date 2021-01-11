<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\User;
use app\widgets\SignInWidget\SignInWidget;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\widgets\SignUpWidget\models\SignupForm */

$this->title = 'Регистрация пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">

                <?php $form = ActiveForm::begin(['id' => 'form-profile']); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div><?= $form->field($model, 'username') ?></div>
                        <div><?= $form->field($model, 'email')->input('email') ?></div>
                        <div><?= $form->field($model, 'sex')->dropDownList(User::getSexArray())?></div>
                        <div><?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => '+7 (999) 999-99-99',
                            ]) ?></div>
                        <div><?= $form->field($model, 'password')->passwordInput() ?></div>
                        <div><?= $form->field($model, 'password_repeat')->passwordInput() ?></div>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <?= SignInWidget::widget()?>
        <p class="helper">
            Нажимая на кнопку, вы даете согласие на обработку своих персональных данных <a href="/files/police.pdf" target="_blank">политика конфиденциальности</a>
        </p>
    </div>

</div>