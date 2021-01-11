<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sliders */

$this->title = 'Изменение слайдера';
$this->params['breadcrumbs'][] = ['label' => 'Управление слайдерами', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="sliders-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
