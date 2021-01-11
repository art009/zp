<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Depart */

$this->title = 'Обновление департамента: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список департаменттов', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменение';
?>

<?= $this->render('_form', [
	'model' => $model,
]) ?>
