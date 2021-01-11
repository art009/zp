<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Staff */

$this->title = 'Новый сотрудник';
$this->params['breadcrumbs'][] = ['label' => 'Список сотрудников', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-create">
    <?= $this->render('_form', [
        'model' => $model,
        'page' => $page
    ]) ?>
</div>
