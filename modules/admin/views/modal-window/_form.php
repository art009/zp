<?php
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModalWindow */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
$('#modalwindow-daterange').daterangepicker({
	autoclose: true,
	locale: {
      format: 'DD.MM.YYYY'
    }
});
JS;

$this->registerJs($script,$this::POS_READY);
?>

<div class="row">
	<div class="col-md-12">
		<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
		<div class="box">
			<!-- /.box-header -->
			<div class="box-body">
				<?php $form = ActiveForm::begin(); ?>
				<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
				<?php //= $form->field($model, 'content')->textarea(['rows' => 6]) ?>


				<?= $form->field($model, 'content')->widget(CKEditor::className(),[
					'editorOptions' => [

						'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
						'inline' => false, //по умолчанию false
						'height' => '200',
						'allowedContent' => true,

						'toolbarGroups' => [
							[
								'name' => 'document',
								'groups' => ['mode'],
							],
							'/',
							['name' => 'styles'],
							['name' => 'blocks'],
						],

						'filebrowserUploadUrl' => Yii::$app->urlManager->createUrl('/admin/default/upload'),
						//'filebrowserUploadUrl' => Yii::$app->urlManager->createUrl('/admin/default/uploadFile'),
					],
				]);?>
				<div class="row">
					<?= $form->field($model, 'daterange',[
						'options' => [
							'class' => 'col-lg-6'
						]
					])->textInput() ?>
					<?= $form->field($model, 'type_show',[
						'options' => [
							'class' => 'col-lg-6'
						]
					])->dropDownList(\app\models\ModalWindow::getType()) ?>
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