<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modelsSearch\Menu */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блоки меню';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('<i class="fas fa-plus"></i> Новый блок меню', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-bordered table-striped'
                ],
                'options' => [
                    'tag' => false,
//                    'class' => 'box-body'
                ],
                'layout' => '<div class="box-body">{items}</div><div class="box-footer clearfix"><div class="col-lg-5">{summary}</div><div class="col-lg-7">{pager}</div></div>',
                'summaryOptions' => [
                    'class' => 'dataTables_info',
                ],
                'columns' => [
                    'id',
                    'name',
                    'description',
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
                        'template' => '{update} {delete}',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
