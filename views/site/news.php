<?php
/**
 * @var $page \app\models\Pages
 * */
use yii\helpers\Html;
use app\helpers\Pages;

$this->params['breadcrumbs'][] = [
	'label' => 'Все новости',
	'url' => Pages::getUrlByLayout(Pages::LAYOUT_NEWS_LIST),
];
$this->params['breadcrumbs'][] = $page->title_page;
?>

<div class="container">
	<div class="row">
		<div class="col-lg-10">
			<h1><?=$page->title_page;?></h1>
		</div>
		<div class="col-lg-2">
			<p class="text-rigth mt-4"><?=Html::a('Все новости',Pages::getUrlByLayout(Pages::LAYOUT_NEWS_LIST),['class'=>'btn-list'])?></p>
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
