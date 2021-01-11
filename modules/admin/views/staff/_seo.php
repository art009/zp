<?php
/* @var $this yii\web\View */
/* @var $page app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>
<?= $form->field($page, 'meta_title')->textInput(['maxlength' => true]) ?>
<?= $form->field($page, 'meta_keywords')->textInput(['maxlength' => true]) ?>
<?= $form->field($page, 'meta_description')->textInput(['maxlength' => true]) ?>