<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use app\models\Pages;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $model app\models\Staff */
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
                <?=Tabs::widget([
                    'items' => [
                        [
                            'label' => 'Содержание',
                            'content' => $this->render('_content',['page' => $page, 'model' => $model,'form' => $form,]),
                            'active' => true
                        ],
                        /*
                        [
                            'label' => 'Страницы',
                            'content' => $this->render('_pages',['model' => $model,'form' => $form]),
                        ],
                        */
                        [
                            'label' => 'SEO',
                            'content' => $this->render('_seo',['page' => $page,'form' => $form]),
                        ],
                    ],
                ]);?>
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
