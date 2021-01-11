<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $page app\models\Pages */

$this->title = 'Изменение данных: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список сотрудников', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменение данных';
?>

<div class="staff-update">
    <?= $this->render('_form', [
        'model' => $model,
        'page' => $page
    ]) ?>
</div>
