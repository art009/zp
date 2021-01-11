<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CategoryMenu */

$this->title = 'Create Category Menu';
$this->params['breadcrumbs'][] = ['label' => 'Category Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
