<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    use app\widgets\GoogleReCaptcha\GoogleReCaptcha;

    $param_btn = [
		'class' => 'btn btn-orange',
		'onclick' => 'sendContact(this,event)',
	];

    if (!empty($goal))
        $param_btn['data-goal'] = $goal;
?>

<?php $form = ActiveForm::begin([
    'id' => 'contact-form',
    'action' => '/site/contact-form',
]); ?>
    <div class="row blue">
        <div class="col-md-6">
            <?= $form->field($model, 'name')
                ->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Имя',
                ])
                ->label(false) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone')
                ->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '+7(999)999-99-99',
                    //'placeholder' => 'Телефон',
                ])
                ->textInput(['placeholder' => 'Телефон',])
                ->label(false) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'message')
                ->textarea([
                    'rows' => 3,
                    'placeholder' => 'Сообщение',
                ])
                ->label(false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'reCaptcha')->widget(
                GoogleReCaptcha::className()
            )->label(false) ?>
            <?= Html::activeHiddenInput($model,'person');?>
            <?= Html::button('Отправить', $param_btn) ?>
        </div>
        <div class="col-md-8">
            <p class="navbar-text">Отправляя данные, я соглашаюсь с
                <?=Html::a('политикой обработки персональных данных','/tos.htm',['class' => 'polit-link'])?>
            </p>
        </div>
    </div>

<?php ActiveForm::end(); ?>