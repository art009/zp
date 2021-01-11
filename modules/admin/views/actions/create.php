<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pages */

$this->title = 'Новая акция';
$this->params['breadcrumbs'][] = ['label' => 'Список акций', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">
    <?= $this->render('_form', [
        'model' => $model,
        'ext_page' => $ext_page,
    ]) ?>

</div>
