<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="container">
	<h1><?= Html::encode($this->title) ?></h1>
	<div class="row">
		<div class="col-lg-12">
			<div class="body-content">
				<p><?= nl2br(Html::encode($message)) ?>*</p>
			</div>
		</div>
	</div>
</div>