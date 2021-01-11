<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\widgets\Pjax;
use app\modules\admin\components\GridView;

$this->title = 'Список новостей';
$this->params['breadcrumbs'][] = $this->title;
$action_links[] = Html::a(
    '<i class="fas fa-plus"></i>&nbsp;Добавить новости',
    ['create'],
    ['class' => 'btn btn-success btn-flat btn-sm']
);?>

<div class="row">
    <div class="col-md-12">
        <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'title' => $this->title,
                'buttons' => $action_links,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'title_page',
                        'format' => 'html',
                        'value' => function($data) {return Html::a($data->title_page, $data->urlPage,['target' => '_blank']);},
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function($data){return \app\helpers\Pages::getLabelStatus($data->status);},
                        'filter' => \app\helpers\Pages::getArrayStatus(),
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => function($data){return date('d.m.Y',$data->created_at);}
                    ],
                    [
                        'attribute' => 'created_by',
                        'value' => function($data){return $data->creater->username;}
                    ],
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
