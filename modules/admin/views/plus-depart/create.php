<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PlusDepart */

$this->title = 'Новый сервис';
$this->params['breadcrumbs'][] = ['label' => 'Управление сервисами', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plus-depart-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
