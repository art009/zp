<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yiidreamteam\jstree\JsTree;
use yii\helpers\Url;

/**
 * @var $this yii\web\View
 * @var $model app\models\PriceList
 * @var $form yii\widgets\ActiveForm
 * @var $item app\models\PriceItems
 */
?>

<div class="row">
		<div class="col-md-12">
			<div class="box box-default <?=(!$model->isNewRecord)?'collapsed-box':''?>">
				<?php if(!$model->isNewRecord):?>
					<div class="box-header with-border">
						<h3 class="box-title">Заголовок прайса</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
							</button>
						</div>
						<!-- /.box-tools -->
					</div>
				<?php endif;?>
				<div class="box-body">
					<?php $form = ActiveForm::begin(); ?>
					<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
					<div class="form-group">
						<?= Html::submitButton($model->isNewRecord ? 'Новый прайс' : 'Обновить прайс', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>

<?php if(!$model->isNewRecord):?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header">
				Список позиций прайса
			</div>
			<div class="box-body">
				<?php $form = ActiveForm::begin([
					'action' => ['add-item'],
				]); ?>
					<?=Html::activeHiddenInput($item,'price_id')?>
					<?= $form->field($item, 'item')->textInput(['maxlength' => true]) ?>
					<?= $form->field($item, 'price')->textInput(['maxlength' => true]) ?>
					<div class="form-group">
						<?= Html::submitButton('Новая позиция', [
							'class' => 'btn btn-primary',
							'onclick' => 'addItemPrice(this,event)',
						]) ?>
					</div>
				<?php ActiveForm::end(); ?>

				<table id="list-price-items" class="table table-striped">
					<tr>
						<th>Наименование позиции</th>
						<th>Цена</th>
						<th>Действия</th>
					</tr>

					<?php foreach($items as $price): ?>
						<tr>
							<td><?=$price->item?></td>
							<td><?=$price->price?></td>
							<td>
								<?=Html::a('<i class="fas fa-trash-alt"></i>',['delete-item','id'=>$price->id],[
									'class' => 'btn btn-danger btn-xs btn-flat',
									'onclick' => 'deleteItemPrice(this,event)',
								])?>
							</td>
						</tr>
					<?php endforeach;?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif;?>
