<?php
    use app\widgets\GalleryWidget\GalleryWidget;
    use app\widgets\StaffWidget\StaffWidget;
?>

<div class="container">
	<h1><?=$page->title_page;?></h1>
	<div class="row">
		<div class="col-lg-12">
			<div class="body-content">
				<?=$page->content;?>

				<?=StaffWidget::widget(['page' => $page->id,]);?>

				<?=GalleryWidget::widget(['page_id' => $page->id]) ?>
			</div>
		</div>
	</div>
</div>