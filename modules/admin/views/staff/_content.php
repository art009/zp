<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use dosamigos\switchinput\SwitchBox;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $page app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'depart')->dropDownList(\app\models\Depart::getDepartList()) ?>
        <?= $form->field($model, 'position')->textarea(['rows' => 3]) ?>
        <?php //= $form->field($model, 'is_record')->checkbox() ?>
        <?= $form->field($model, 'is_record')->widget(SwitchBox::className(),[
            'options' => [
                //'uncheck' => false,
                'label' => false,
            ],
            'clientOptions' => [
                'size' => 'normal',
                'onColor' => 'success',
                'offColor' => 'danger',
                'onText' => 'Show',
                'offText' => 'Hide',
                'state' =>  ($model->is_record == 1),
            ],

            'clientEvents' => [
                'switchChange.bootstrapSwitch' => 'function(event, state) {
                    if (state) {
                        $("#staff-is_record").val(1);
                    } else {
                        $("#staff-is_record").val(0);
                    }
                }'
            ],

        ])->label();?>
	    <?= $form->field($model, 'is_online')->widget(SwitchBox::className(),[
		    'options' => [
			    //'uncheck' => false,
			    'label' => false,
		    ],
		    'clientOptions' => [
			    'size' => 'normal',
			    'onColor' => 'success',
			    'offColor' => 'danger',
			    'onText' => 'Show',
			    'offText' => 'Hide',
			    'state' =>  ($model->is_online == 1),
		    ],

		    'clientEvents' => [
			    'switchChange.bootstrapSwitch' => 'function(event, state) {
                    if (state) {
                        $("#staff-is_online").val(1);
                    } else {
                        $("#staff-is_online").val(0);
                    }
                }'
		    ],

	    ])->label();?>
	    <?= $form->field($model, 'is_home')->widget(SwitchBox::className(),[
		    'options' => [
			    //'uncheck' => false,
			    'label' => false,
		    ],
		    'clientOptions' => [
			    'size' => 'normal',
			    'onColor' => 'success',
			    'offColor' => 'danger',
			    'onText' => 'Show',
			    'offText' => 'Hide',
			    'state' =>  ($model->is_home == 1),
		    ],

		    'clientEvents' => [
			    'switchChange.bootstrapSwitch' => 'function(event, state) {
                    if (state) {
                        $("#staff-is_home").val(1);
                    } else {
                        $("#staff-is_home").val(0);
                    }
                }'
		    ],

	    ])->label();?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'imageFile')->fileInput() ?>
        <?php if($model->photo) echo Html::img($model->getImgLink(),['class' => 'img-thumbnail'])?>
    </div>
</div>

<?= $form->field($page, 'content')->widget(CKEditor::className(),[
    'editorOptions' => [
        'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
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
    ],
]);?>
