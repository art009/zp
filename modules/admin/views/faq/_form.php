<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'created_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'status')->dropDownList(\app\models\Reviews::getSatusReviews()) ?>
                        <?= $form->field($model, 'category_id')->dropDownList(\app\helpers\Reviews::Categories()) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'review')->textarea(['rows' => 6]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

                <div class="box-tools">
                    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Добавить' : '<i class="fa fa-save"></i> Изменить', ['class' => $model->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat']) ?>
                </div>
            </div>
            <!-- box-footer -->
        </div>
        <!-- /.box -->
        <?php ActiveForm::end(); ?>
    </div>
</div>