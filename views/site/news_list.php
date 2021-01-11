<?php
/**
 * @var $page \app\models\Pages
 * */
use app\widgets\NewsWidget\NewsWidget;
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">

			<h1><?= $page->title_page;?></h1>

			<div class="body-content">
				<?= NewsWidget::widget([
					'on_main' => false,
				]);?>
				<?= $page->content;?>
			</div>
		</div>
	</div>
</div>
