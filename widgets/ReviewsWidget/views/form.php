<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\GoogleReCaptcha\GoogleReCaptcha;

$btn_params = [
	'class' => 'btn btn-feedback',
	'onclick' => 'sendReviews(this,event)'
];

if ($goal)
	$btn_params['data-goal'] = $goal;
?>

<?php $form = ActiveForm::begin([
	'id' => 'q-form',
    'action' => Yii::$app->urlManager->createUrl([
        '/site/add-reviews',
        'source' => 'site',
        'text' => 'Отзыв вопрос'
    ]),
]); ?>
    <div class="wrap-form">
        <?= $form->field($model, 'created_name')
            ->textInput([
                'maxlength' => true,
                'placeholder' => 'Ваше имя',
            ])
            ->label(false) ?>
        <?= $form->field($model, 'phone')
            ->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7(999)999-99-99',
            ])
            ->textInput(['placeholder' => 'Телефон',])
            ->label(false) ?>
        <?= $form->field($model, 'email')
            ->textInput([
                'maxlength' => true,
                'placeholder' => 'Email',
            ])
            ->label(false) ?>
        <?= $form->field($model, 'review')
            ->textarea([
                'rows' => 3,
                'placeholder' => 'Сообщение',
            ])
            ->label(false) ?>

    </div>
    <div class="form-check">
         <?= $form->field($model, 'agree', [
            'template' => "{input}{label}{error}",
            ])
             ->checkbox(['class' => 'form-check-input'],false)
             ->label('я принимаю условия<br/> <a href="/tos.htm">Пользовательского соглашения</a>')
         ?>

    </div>

<?= $form->field($model, 'reCaptcha')->widget(
    GoogleReCaptcha::class
)->label(false) ?>

<?=Html::activeHiddenInput($model,'depart',[
		'value' => !empty(\Yii::$app->params['depart'])?\Yii::$app->params['depart']:null,
])?>

    <?= Html::button('Отправить', $btn_params) ?>

<?php ActiveForm::end(); ?>