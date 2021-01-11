<?php
use yii\helpers\Html;
use app\helpers\Pages;

$this->params['breadcrumbs'][] = $worker->name;
?>

<div class="container">
	<h1><?=$worker->name;?></h1>
	<div class="row">
		<div class="col-md-4">
			<?=Html::img($worker->getImgLink(),['alt' => $worker->name,'class'=>'img-thumbnail'])?>
			<br/>
			<b><?=$worker->position?></b>
		</div>
		<div class="row person-description">
			<div class="col-12">
				<?=$page->content;?>
			</div>
		</div>
	</div>
</div>