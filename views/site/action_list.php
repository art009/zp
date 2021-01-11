<?php
use app\widgets\ActionWidget\ActionWidget;

$this->params['breadcrumbs'][] = $page->title_page;
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">

			<h1><?= $page->title_page;?></h1>

			<div class="body-content">
				<?=ActionWidget::widget();?>
				<?= $page->content;?>
			</div>
		</div>
	</div>
</div>