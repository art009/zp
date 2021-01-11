<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Depart */

$this->title = 'Новое подразделение';
$this->params['breadcrumbs'][] = ['label' => 'Список подразделений', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="depart-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
