<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ModalWindow */

$this->title = 'Новое модальное окно';
$this->params['breadcrumbs'][] = ['label' => 'Управление модальным окном', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-window-create">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>
