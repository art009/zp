<?php

use app\helpers\Pages;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $ext_page app\models\ExtPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-6">
        <?= $form->field($model, 'title_page')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->dropDownList(Pages::getArrayStatus()) ?>
        <?= $form->field($ext_page,'depart')->dropDownList(\app\models\Depart::getDepartList())?>
        <?= $form->field($ext_page,'shor_content')->textarea(['rows' => 3])?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($ext_page, 'clear_img')->checkbox() ?>
        <?= $form->field($ext_page, 'imageFile')->fileInput() ?>
        <?php if($ext_page->cover) echo Html::img($ext_page->getCoverUrl(),['class' => 'img-thumbnail']);?>
        <?= $form->field($ext_page, 'imageMainFile')->fileInput() ?>
        <?php if($ext_page->image) echo Html::img($ext_page->getMainImageUrl(),['class' => 'img-thumbnail']);?>
    </div>
</div>

<?= $form->field($model, 'content')->widget(CKEditor::className(),[
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

