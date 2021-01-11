<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use app\modules\admin\assets\UrlifyAsset;
use app\modules\admin\assets\SortableAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
/* @var $ext_page \app\models\ExtPage */

UrlifyAsset::register($this);
SortableAsset::register($this);
?>

<?=$this->registerJs('
$("#pages-title_page").blur(function(){
    if ($("#pages-url").val() <= 0)
        $("#pages-url").val(window.URLify($("#pages-title_page").val()));
    if ($("#pages-meta_title").val() <= 0)
        $("#pages-meta_title").val($("#pages-title_page").val());
});
',$this::POS_READY)?>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>
        <div class="nav-tabs-custom">
            <?=Tabs::widget([
                'items' => [
                    [
                        'label' => 'Содержание',
                        'content' => $this->render('_content',['model' => $model,'form' => $form,'ext_page' => $ext_page,]),
                        'active' => true
                    ],
                    [
                        'label' => 'SEO',
                        'content' => $this->render('_seo',['model' => $model,'form' => $form]),
                    ],
                    [
                        'label' => 'Галерея',
                        'content' => $this->render('_gallery',['model' => $model,'form' => $form, 'image' => $image, 'imageList' => $imageList]),
                        'visible' => !$model->isNewRecord,
                    ],
                    [
                        'label' => 'Сотрудники',
                        'content' => $this->render('_staff',['model' => $model,'form' => $form]),
                        'visible' => !$model->isNewRecord,
                    ],
	                [
		                'label' => 'Прайс листы',
		                'content' => $this->render('_price',['model' => $model,'form' => $form]),
		                'visible' => !$model->isNewRecord,
	                ],
                ],
            ]);?>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
