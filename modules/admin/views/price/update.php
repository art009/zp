<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */

$this->title = 'Изменение прайс листа';
$this->params['breadcrumbs'][] = ['label' => 'Список прайсов', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменение';
?>

<?= $this->render('_form', [
	'model' => $model,
	'item' => $item,
	'items' => $items,
]) ?>
