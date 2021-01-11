<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use app\modules\admin\components\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modelsSearch\Depart */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление подразделениями';
$this->params['breadcrumbs'][] = $this->title;

$action_links[] = Html::a(
	'<i class="fas fa-plus"></i>&nbsp;Добавить подразделение',
	['create'],
	['class' => 'btn btn-success btn-flat btn-sm']
);
?>
<div class="depart-index">

	<div class="row">
		<div class="col-md-12">
			<?php Pjax::begin(); ?>
				<?= GridView::widget([
				'dataProvider'	=> $dataProvider,
				'filterModel'	=> $searchModel,
				'title'			=> $this->title,
				'buttons'		=> $action_links,
					'columns' => [
//						['class' => 'yii\grid\SerialColumn'],

//						'id',
						'name',
//						'slug',
						'phone',
						'email:email',
						[
							'attribute' => 'is_main',
							'format' => 'html',
							'value' => function($data){return ($data->is_main)?'<i class="fa fa-star text-yellow"></i>':'';},
							'filter' => false,
						],
						//'address',
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
