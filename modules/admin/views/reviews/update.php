<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

$this->title = 'Изменение отзыва: #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="reviews-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
