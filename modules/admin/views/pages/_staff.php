<?php
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Html;

// The controller action that will render the list
$url = \yii\helpers\Url::to(['/admin/default/staff-list']);

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-6">
        <?= Select2::widget([
            'name' => 'staff_id',
            'initValueText' => '', // set the initial display text
            'options' => ['placeholder' => 'Выберите сотрудника ...'],
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
        <?=Html::activeHiddenInput($model,'persons_id')?>
        <table id="table-pages" class="table table-bordered">
            <thead>
                <tr>
                    <th width="20px">##</th>
                    <th>Сотрудник</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->staff as $person):?>
                    <tr data-id="<?=$person->id?>">
                        <td><i class="fa fa-arrows-alt"></i></td>
                        <td><?=$person->name?></td>
                        <td><?=Html::a('Удалить','#',['onclick' => 'rmPageRow(this,event)'])?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>


<?php $this->registerJs('$("#table-pages").sortable({
    containerSelector: "table",
    itemPath: "> tbody",
    itemSelector: "tr",
    placeholder: "<tr class=\'placeholder\'><td colspan=\'3\'></tr>",
    onDrop: function($item, container, _super) {recallStaff();}
  })',$this::POS_END)?>