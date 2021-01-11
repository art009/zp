<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\modules\admin\components\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modelsSearch\PriceList */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление прайсами';
$this->params['breadcrumbs'][] = $this->title;

$action_links[] = Html::a(
	'<i class="fas fa-plus"></i>&nbsp;Новый прайс',
	['create'],
	['class' => 'btn btn-success btn-flat btn-sm']
);
?>

<div class="row">
	<div class="col-md-12">
		<?php Pjax::begin(); ?>
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'title' => $this->title,
			'buttons' => $action_links,
			'columns' => [
				'title',
				[
					'class' => 'yii\grid\ActionColumn',
					'template' => '{update}&nbsp;{delete}',
					'buttons' => [
						'update' => function ($url,$model) {
							//$url = Yii::$app->urlManager->createUrl(['/hotels/update','id' => $model->id]);
							return Html::a('<i class="fa fa-edit"></i>', $url, [
								'class' => 'btn btn-success btn-xs btn-flat',
								'title' => 'Редактировать',
								'aria-label' => 'Редактировать',
							]);
						},
						'delete' => function ($url,$model,$key) {
							return Html::a('<i class="fa fa-trash"></i>', $url,
								[
									'class' => 'btn btn-danger btn-xs btn-flat',
									'title' => 'Удалить',
									'data' => [
										'pjax' => 0,
										'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
										'method' => 'post'
									]
								]);
						},
					],
				],
			],
		]); ?>
		<?php Pjax::end(); ?>
	</div>
</div>
