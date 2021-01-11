<?php
/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>
<?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>