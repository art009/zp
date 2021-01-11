<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */

$this->title = 'Обновление блока меню: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список блоков меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменение';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
