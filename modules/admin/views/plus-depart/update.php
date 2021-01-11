<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PlusDepart */

$this->title = 'Изменение сервис: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Управление сервисами', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменинение';
?>
<div class="plus-depart-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
