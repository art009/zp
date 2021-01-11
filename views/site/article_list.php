<?php
use app\widgets\ArticlesWidget\ArticlesWidget;
$this->params['breadcrumbs'][] = $page->title_page;
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">

			<h1><?= $page->title_page;?></h1>

			<div class="body-content">
				<?=ArticlesWidget::widget([
					'on_main' => false,
				]);?>
				<?= $page->content;?>
			</div>
		</div>
	</div>
</div>