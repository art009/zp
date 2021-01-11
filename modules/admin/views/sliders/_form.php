<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Sliders */
/* @var $form yii\widgets\ActiveForm */

$url = \yii\helpers\Url::to(['/admin/default/pages-list']);
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
                <?= $form->field($model, 'imageFile')->fileInput() ?>

                <?php if($model->images) echo Html::img($model->getImgLink(),['class' => 'img-thumbnail'])?>
				<div class="row">
					<?= $form->field($model, 'name',['options'=>[
						'class' => 'col-lg-6'
					]])->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'description',['options'=>[
						'class' => 'col-lg-6'
					]])->textInput(['maxlength' => true]) ?>
					<?= $form->field($model, 'depart',['options'=>[
						'class' => 'col-lg-6'
					]])->dropDownList(\app\models\Depart::getDepartList()) ?>
					<?= $form->field($model, 'position',['options'=>[
						'class' => 'col-lg-6'
					]])->textInput(['maxlength' => true]) ?>
					<?= $form->field($model, 'url',['options'=>[
						'class' => 'col-lg-6'
					]])->textInput(['maxlength' => true]) ?>
					<?= $form->field($model, 'page_id',['options'=>[
						'class' => 'col-lg-6'
					]])->widget(Select2::classname(), [
						'initValueText' => ($model->page) ? $model->page->title_page : '', // set the initial display text
						'options' => ['placeholder' => 'Выберите страницу ...'],
						'pluginOptions' => [
							'allowClear' => true,
							'minimumInputLength' => 3,
							'language' => [
								'errorLoading' => new JsExpression("function () { return 'Идет поиск...'; }"),
							],
							'ajax' => [
								'url' => $url,
								'dataType' => 'json',
								'data' => new JsExpression('function(params) { return {q:params.term}; }')
							],
							'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
							'templateResult' => new JsExpression('function(page) { return page.text; }'),
							'templateSelection' => new JsExpression('function (page) { return page.text; }'),
						],
					]); ?>
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
