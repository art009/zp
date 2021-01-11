<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Depart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-body">
				<?php $form = ActiveForm::begin(); ?>
				<div class="row">
					<?= $form->field($model, 'name',['options'=>['class'=>'col-lg-6']])->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'slug',['options'=>['class'=>'col-lg-6']])->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'phone',['options'=>['class'=>'col-lg-6']])->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'email',['options'=>['class'=>'col-lg-6']])->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'is_main',['options'=>['class'=>'col-lg-6']])->checkbox() ?>
				</div>
				<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'mails')->textInput(['maxlength' => true]) ?>

				<div class="row">
					<div class="col-lg-6">
						<?= $form->field($model, 'imageFile')->fileInput() ?>
						<?= $form->field($model, 'remove_image')->checkbox() ?>
					</div>
					<?php if($model->image) echo '<div class="col-lg-6">'.Html::img($model->getImgLink(),['class' => 'img-thumbnail']).'</div>'?>
				</div>
				<div class="form-group">
					<?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o" aria-hidden="true"></i> Новый филиал' : '<i class="fa fa-floppy-o" aria-hidden="true"></i> Обновить блок', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>
