<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Pjax;
use app\models\Reviews;
use app\modules\admin\components\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modelsSearch\Reviews */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление вопросами/ответами';
$this->params['breadcrumbs'][] = $this->title;

$action_links[] = Html::a(
    '<i class="fas fa-plus"></i>&nbsp;Добавить "Вопрос/Ответ"',
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
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'status',
                        'value' => function($data) {return Reviews::getSatusReviews()[$data->status];},
                        'filter' => Reviews::getSatusReviews(),
                    ],
                    [
                        'attribute' => 'created_name',
                        'format' => 'html',
                        'value' => function($data) {return Html::mailto($data->created_name,$data->email);},
                    ],
                    [
                        'attribute' => 'review',
                        'value' => function ($data) {return HtmlPurifier::process($data->review);},
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => function($data) {return date('d.m.Y H:i',$data->created_at);},
                        'filter' => false,
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{set-active}&nbsp;{set-block}&nbsp;{update}&nbsp;{delete}',
                        'headerOptions' => [
                            'width' => '150px',
                        ],
                        'buttons' => [
                            'set-active' => function ($url, $model, $key) {
                                $url = Yii::$app->urlManager->createUrl(['/admin/faq/change-status','id' => $model->id]);
                                $options = [
                                    'class' => 'btn btn-success btn-xs btn-flat',
                                    'title' => 'Активировать',
                                    'aria-label' => 'Активировать',
                                    'onclick' => 'changeStatusReview(this,event)',
                                    'data-value' => Reviews::STATUS_ACTIVE,
                                    'data-attribute' => 'status',
                                ];
                                if (in_array($model->status,[$model::STATUS_NEW,$model::STATUS_BLOCK]))
                                    return Html::a('<i class="fas fa-check"></i>', $url, $options);
                            },
                            'set-block' => function ($url, $model, $key) {
                                $url = Yii::$app->urlManager->createUrl(['/admin/faq/change-status','id' => $model->id]);
                                $options = [
                                    'class' => 'btn btn-danger btn-xs btn-flat',
                                    'title' => 'Блокировать',
                                    'aria-label' => 'Блокировать',
                                    'onclick' => 'changeStatusReview(this,event)',
                                    'data-value' => Reviews::STATUS_BLOCK,
                                    'data-attribute' => 'status',
                                ];
                                if (in_array($model->status,[$model::STATUS_NEW,$model::STATUS_ACTIVE]))
                                    return Html::a('<i class="fas fa-ban"></i>', $url, $options);
                            },
                            'update' => function ($url,$model,$key) {
                                return Html::a('<i class="fas fa-pencil-alt"></i>', $url,
                                    [
                                        'class' => 'btn btn-success btn-xs btn-flat',
                                        'title' => 'Изменить',
                                        'data' => [
                                            'pjax' => 0,
                                        ]
                                    ]);
                            },
                            'delete' => function ($url,$model,$key) {
                                return Html::a('<i class="fas fa-trash-alt"></i>', $url,
                                    [
                                        'class' => 'btn btn-danger btn-xs btn-flat',
                                        'title' => 'Удалить',
                                        'data' => [
                                            'pjax' => 0,
                                            'confirm' => 'Вы уверены, что хотите удалить этот вопрос?',
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
