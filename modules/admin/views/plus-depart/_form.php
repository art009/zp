<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PlusDepart */
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
					<?= $form->field($model, 'title',['options'=>[
						'class' => 'col-lg-6'
					]])->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'icon',['options'=>[
						'class' => 'col-lg-6'
					]])->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'depart_id',['options'=>[
						'class' => 'col-lg-6'
					]])->dropDownList(\app\models\Depart::getDepartList()) ?>

					<?= $form->field($model, 'link',['options'=>[
						'class' => 'col-lg-6'
					]])->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'content',['options'=>[
						'class' => 'col-lg-12'
					]])->textarea(['rows' => 6]) ?>
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
