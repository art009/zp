<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\modules\admin\components\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\modelsSearch\User; */

$this->title = 'Управление пользователями';
$this->params['breadcrumbs'][] = $this->title;

$action_links[] = Html::a(
    '<i class="fas fa-plus"></i>&nbsp;Добавить пользователя',
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
        //            ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'id',
                        'headerOptions' => [
                            'width' => '50px',
                        ],
                    ],
                    'username',
//                    'email:email',
                    [
                        'attribute' => 'email',
                        'format' => 'html',
                        'value' => function($data) {return Html::mailto($data->email,$data->email);},
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function($data){return User::getStatusArray()[$data->status];},
                        'filter' => User::getStatusArray(),
                    ],
                    /*[
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
                    ],*/
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{change-password}&nbsp;{permissions}&nbsp;{update}&nbsp;{delete}',
                        'buttons' => [
                            'change-password' => function ($url, $model, $key) {
                                $options = [
                                    'class' => 'btn btn-success btn-xs btn-flat',
                                    'title' => 'Сменить пароль',
                                    'aria-label' => 'Сменить пароль',
                                    'onclick' => 'changePassword(this,event)',
                                    'data-pjax' => '0',
                                ];
                                return Html::a('<span class="fa fa-key"></span>', $url, $options);
                            },
                            'permissions' => function ($url, $model, $key) {
                                if (!Yii::$app->user->can('userPermissions', ['user' => $model])) {
                                    return '';
                                }
                                $options = [
                                    'class' => 'btn btn-success btn-xs btn-flat',
                                    'title' => Yii::t('users', 'PERMISSIONS'),
                                    'aria-label' => Yii::t('users', 'PERMISSIONS'),
                                    'data-pjax' => '0',
                                ];
                                return Html::a('<span class="glyphicon glyphicon-cog"></span>', $url, $options);
                            },
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
