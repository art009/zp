<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */

$this->title = 'Изменение в статье: ' . $model->title_page;
$this->params['breadcrumbs'][] = ['label' => 'Список статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменение';

?>
<div class="pages-update">

    <?= $this->render('_form', [
        'model' => $model,
        'ext_page' => $ext_page,
    ]) ?>

</div>
