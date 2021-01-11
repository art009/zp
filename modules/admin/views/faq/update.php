<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

$this->title = 'Изменение "Вопроса/Ответа": ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Управление вопросами/ответами', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="reviews-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
