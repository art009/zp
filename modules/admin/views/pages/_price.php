<?php
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Html;

// The controller action that will render the list
$url = \yii\helpers\Url::to(['/admin/default/price-list','page_id'=>$model->id]);

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>
	<div class="row">
		<div class="col-md-6">
			<?= Select2::widget([
				'name' => 'price_id',
				'initValueText' => '', // set the initial display text
				'options' => ['placeholder' => 'Выберите прайс ...'],
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
					'select2:select' => new JsExpression('function(e) { var data = e.params.data;addPrice(data); }'),
				],
			]); ?>
		</div>
		<div class="col-md-6">
			<?=Html::activeHiddenInput($model,'price_id')?>
			<table id="table-price" class="table table-bordered">
				<thead>
				<tr>

					<th>Прайс лист</th>
					<th>Удалить</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($model->price as $price):?>
					<tr data-id="<?=$price->id?>">

						<td><?=$price->title?></td>
						<td><?=Html::a('Удалить',
								['delete-price','page_id' => $model->id,'price_id' => $price->id],
								['onclick' => 'rmPagePriceRow(this,event)'])?></td>
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