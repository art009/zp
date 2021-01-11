<?php

use app\helpers\Pages;
use yii\helpers\Html;

?>
<section class="news">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<p class="float-right news-link"><?=Html::a('Все новости',Pages::getUrlByLayout(Pages::LAYOUT_NEWS_LIST))?></p>
				<p class="h2">Новости</p>
			</div>
		</div>
		<div class="row">
			<?php foreach ($news as $news_item):?>
				<div class="col-lg-4">
					<div class="news-time"><?=date('d.m.Y',$news_item->created_at)?></div>
					<div class="news-title">
						<?=Html::a($news_item->title_page,$news_item->urlPage)?>
					</div>
					<div class="news-content">
						<?=$news_item->extPage->getShortContent()?>
					</div>
				</div>
			<?php endforeach;?>
		</div>
		<div class="news-mobile-link">
			<?=Html::a('Все новости',Pages::getUrlByLayout(Pages::LAYOUT_NEWS_LIST))?>
		</div>
		<hr class="mt-5">
	</div>
</section>