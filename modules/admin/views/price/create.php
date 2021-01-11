<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Menu */

$this->title = 'Новый прайс лист';
$this->params['breadcrumbs'][] = ['label' => 'Список прайсов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
	'model' => $model,
]) ?>
