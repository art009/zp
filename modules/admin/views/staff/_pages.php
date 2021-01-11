<?php
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Html;

// The controller action that will render the list
$url = \yii\helpers\Url::to(['/admin/default/pages-list']);

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-6">
        <?= Select2::widget([
            'name' => 'page_id',
            'initValueText' => '', // set the initial display text
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
            'pluginEvents' => [
                'select2:select' => new JsExpression('function(e) { var data = e.params.data;addStaff(data); }'),
            ],
        ]); ?>
    </div>
    <div class="col-md-6">
        <?=Html::activeHiddenInput($model,'pages_id')?>
        <table id="table-pages" class="table table-bordered">
            <tr>
                <th>Страница</th>
                <th>Удалить</th>
            </tr>
            <?php foreach ($model->pages as $page):?>
                <tr data-id="<?=$page->id?>">
                    <td><?=$page->title_page?></td>
                    <td><?=Html::a('Удалить','#',['onclick' => 'rmPageRow(this,event)'])?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
