<?php

use yii\helpers\Html;
use app\modules\admin\components\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modelsSearch\PlusDepart */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление сервисами';
$this->params['breadcrumbs'][] = $this->title;

$action_links[] = Html::a(
	'<i class="fas fa-plus"></i>&nbsp;Новый сервис',
	['create'],
	['class' => 'btn btn-success btn-flat btn-sm']
);
?>
<div class="row">
	<div class="col-md-12">
		<?php Pjax::begin(); ?>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
	//            'filterModel' => $searchModel,
				'title' => $this->title,
				'buttons' => $action_links,
				'columns' => [
//					['class' => 'yii\grid\SerialColumn'],

//					'id',
					'title',
//					'content:ntext',
//					'icon',
//					'depart_id',
					[
						'attribute' => 'depart_id',
						'value' => function($data){return ($data->depart)?$data->depart->name:'не задано';},
						'filter' => \app\models\Depart::getDepartList(),
					],
//					'created_at',
					[
						'attribute' => 'created_at',
						'value' => function($data){return date('d.m.Y',$data->created_at);},
						'filter' => false,
					],
					//'updated_at',
					//'created_by',
					//'updated_by',

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
