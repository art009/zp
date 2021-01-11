<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Basket;
?>

<?php $form = ActiveForm::begin([
    'action' => '/cart/issue-order',
]); ?>
<div class="row">
    <div class="col-md-6">
        <p class="h2">Пользователь:</p>
        <?php if($user):?>
            <p>
                Уважаемый, <?=$user->username?>.<br/>
                Для связи с вами мы будем использовать следующие контактные данные,
                пожалуйста проверьте их и если они не верны отредактируйте их в <?=Html::a('личном кабинете',$user->urlLk)?>:<br/>
                <b>E-mail:</b> <?=$user->email?><br/>
                <b>Телефон:</b> <?=($user->phone)?$user->phone:'не указан'?><br/>
            </p>
        <?php else:?>
            <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
            <?php // $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 (999) 999-99-99',
            ]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?php endif;?>

        <?= $form->field($model, 'type_pay')->dropDownList(Basket::getPayType()) ?>
        <?= $form->field($model, 'type_delivery')->dropDownList(Basket::getTypeDelivery()) ?>

        <div class="form-group">
            <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <div class="col-md-6">
        <p class="h2">Адрес доставка:</p>

        <?php if($user && $user->userAddress):?>
            <?= $form->field($model, 'user_address_id')->dropDownList(ArrayHelper::map($user->userAddress,'id','address')); ?>
        <?php endif;?>

        <?= $form->field($model, 'zip_post')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
