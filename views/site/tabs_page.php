<?php
use app\widgets\GalleryWidget\GalleryWidget;
use app\widgets\StaffWidget\StaffWidget;
use app\widgets\PriceWidget\PriceWidget;
?>

<div class="container">
	<h1><?=$page->title_page;?></h1>
	<div class="row">
		<div class="col-lg-12">
			<div class="body-content">

				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="staff-tab" data-toggle="tab" href="#staff" role="tab" aria-selected="true">Врачи</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-selected="false">Описание</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="price-tab" data-toggle="tab" href="#price" role="tab" aria-selected="false">Цены</a>
					</li>
				</ul>
				<div class="tab-content mt-4">
					<div class="tab-pane fade show active" id="staff" role="tabpanel">
						<?=StaffWidget::widget(['page' => $page->id,]);?>
					</div>
					<div class="tab-pane fade" id="description" role="tabpanel"><?=$page->content;?></div>
					<div class="tab-pane fade" id="price" role="tabpanel">
						<?=PriceWidget::widget(['page' => $page->id]) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>