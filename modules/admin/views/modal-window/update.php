<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ModalWindow */

$this->title = 'Изменение модального окна';
$this->params['breadcrumbs'][] = ['label' => 'Управление модальным окном', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="modal-window-update">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>
