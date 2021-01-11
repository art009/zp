<?php

use app\helpers\Pages;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-6">
        <?= $form->field($model, 'title_page')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        <?= $form->field($ext_page,'depart')->dropDownList(\app\models\Depart::getDepartList())?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'status')->dropDownList(Pages::getArrayStatus()) ?>
        <?= $form->field($model, 'layout')->dropDownList(Pages::getArrayLayout()) ?>
    </div>
</div>

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

