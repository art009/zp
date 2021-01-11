<?php
    use app\widgets\ReviewsWidget\ReviewsWidget;

?>

<div class="container">
	<h1><?=$page->title_page;?></h1>
	<div class="row">
		<div class="col-lg-12">
			<div class="body-content">
				<?=ReviewsWidget::widget()?>
				<?=$page->content;?>
			</div>
		</div>
	</div>
</div>