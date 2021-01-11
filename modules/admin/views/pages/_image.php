<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dmstr\widgets\Alert;

/* @var $image app\models\Gallery */
?>

<?= Alert::widget() ?>

    <div class="row">
        <div class="col-md-12">
            <?=Html::img($model->getUrlImage(),['class' => 'modal-previe'])?>
        </div>
    </div>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
<?php ActiveForm::end(); ?>