<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\modules\admin\components\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modelsSearch\Pages */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление страницами';
$this->params['breadcrumbs'][] = $this->title;


$action_links[] = Html::a(
    '<i class="fas fa-plus"></i>&nbsp;Добавить страницу',
    ['create'],
    ['class' => 'btn btn-success btn-flat btn-sm']
);
?>

<div class="row">
    <div class="col-md-12">
        <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'title' => $this->title,
                'buttons' => $action_links,
                'columns' => [
                    'title_page',
                    [
                        'attribute' => 'status',
                        'value' => function($data){return \app\helpers\Pages::getLabelStatus($data->status);},
                        'filter' => \app\helpers\Pages::getArrayStatus(),
                    ],
                    [
                        'attribute' => 'layout',
                        'value' => function($data){return \app\helpers\Pages::getLabelLayout($data->layout);},
                        'filter' => \app\helpers\Pages::getArrayLayout(),
                    ],
	                [
//		                'header' => 'Подразделение',
		                'attribute' => 'search_depart',
		                'value' => function($data){
							if ($data->depart)
	            				return $data->depart->name;
							else
								return '';
//							\app\helpers\Pages::getLabelLayout($data->layout);
						},
		                'filter' => \app\models\Depart::getList(),
	                ],
                    [
                        'attribute' => 'created_at',
                        'value' => function($data){return date('d.m.Y',$data->created_at);},
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'created_by',
                        'value' => function($data){return $data->creater->username;},
                        'filter' => false,
                    ],
                    [
                        'class' => '\app\modules\admin\components\ActionColumn',
                        'template' => '{update}&nbsp;{delete}',
                        'headerOptions' => [
                            'width' => '100px',
                        ],
                        'buttons' => [
                            'redirect_link' => function ($url,$model,$key) {
                                $url = Url::to([
                                    '/admin/redirect/control',
                                    'page_id' => $model->id,
                                    'model_name' => 'Pages',
                                ]);
                                return Html::a(
                                    '<i class="fas fa-share-square"></i>',
                                    $url,
                                    [
                                        'class' => 'btn btn-default btn-xs btn-flat',
                                        'onclick' => 'set_redirect(this,event)',
                                    ]
                                );
                            },
                        ],
                    ],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>

<div id="modif-pages" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Изменение данных</h4>
            </div>
            <div class="modal-body">
                <p>Загрузка данных&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" onclick="save_form(this)" class="btn btn-primary">Сохранить</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->