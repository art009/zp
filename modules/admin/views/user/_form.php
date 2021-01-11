<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use budyaga\users\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model budyaga\users\models\User */
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
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]); ?>
                        <?= $form->field($model, 'status')->dropDownList(User::getStatusArray()); ?>
                        <?= $form->field($model, '_role')->dropDownList(ArrayHelper::map(Yii::$app->authManager->roles,'name','description')); ?>

                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]); ?>
                        <?php if($model->isNewRecord):?>
                            <?= $form->field($model, '_password')->passwordInput() ?>
                        <?php endif;?>
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
