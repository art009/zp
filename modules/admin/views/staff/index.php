<?php

use yii\helpers\Html;
use app\modules\admin\components\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modelsSearch\Staff */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;

$action_links[] = Html::a(
    '<i class="fas fa-plus"></i>&nbsp;Добавить сотрудника',
    ['create'],
    ['class' => 'btn btn-success btn-flat btn-sm']
);
?>
<div class="staff-index">
    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'title' => $this->title,
            'buttons' => $action_links,
            'columns' => [
                [
                    'attribute' => 'id',
                    'headerOptions' => [
                        'width' => '50px',
                    ],
                ],
                [
                    'attribute' => 'photo',
                    'format' => 'html',
                    'value' => function($data) {return Html::img($data->imgLink,['class' => 'img-thumbnail']);},
                    'headerOptions' => [
                        'width' => '250px',
                    ],
                    'filter' => false,
                ],
//                'photo',
                'name',
                'position',
//                'page_id',
                [
                    'class' => '\app\modules\admin\components\ActionColumn',
                    'headerOptions' => [
                        'width' => '150px',
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
