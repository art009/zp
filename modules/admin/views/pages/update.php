<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $image app\models\Gallery */
/* @var $imageList app\models\Gallery */
/* @var $ext_page \app\models\ExtPage */

$this->title = 'Изменение в странице: ' . $model->title_page;
$this->params['breadcrumbs'][] = ['label' => 'Список страниц', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="pages-update">

    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
        'imageList' => $imageList,
	    'ext_page' => $ext_page,
    ]) ?>

</div>
