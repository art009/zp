<?php
use yii\helpers\Html;
use app\helpers\Pages;

$this->params['breadcrumbs'][] = [
    'label' => 'Все акции',
    'url' => Pages::getUrlByLayout(Pages::LAYOUT_ACTIONS_LIST),
];
$this->params['breadcrumbs'][] = $page->title_page;
?>

<div class="container">
	<div class="row">
		<div class="col-lg-11">
			<h1><?=$page->title_page;?></h1>
		</div>
		<div class="col-lg-1">
			<p class="text-rigth mt-4"><?=Html::a('Все акции',Pages::getUrlByLayout(Pages::LAYOUT_ACTIONS_LIST))?></p>
		</div>

		<div class="col-lg-12">
			<div class="body-content">
				<?php if($page->extPage && $page->extPage->image):?>
					<?= Html::img($page->extPage->getMainImageUrl(),['class' => 'news-thumbnail'])?>
				<?php endif;?>
				<?=$page->content;?>
			</div>
		</div>
	</div>
</div>
