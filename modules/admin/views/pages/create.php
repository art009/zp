<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $image app\models\Gallery */
/* @var $imageList string */
/* @var $ext_page \app\models\ExtPage */

$this->title = 'Новая страница';
$this->params['breadcrumbs'][] = ['label' => 'Список страниц', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">
    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
        'imageList' => $imageList,
	    'ext_page' => $ext_page,
    ]) ?>

</div>
