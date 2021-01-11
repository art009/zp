<?php

use yii\helpers\Html;
use app\helpers\Pages;

/**
 * @property app\models\Pages $articles
 */
?>

<section class="articles mt-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<p class="float-right article-link">
					<?=Html::a('Все статьи',Pages::getUrlByLayout(Pages::LAYOUT_ARTICLE_LIST))?></p>
				<p class="h2">Статьи и полезные материалы</p>
			</div>

			<?php foreach ($articles as $article):?>
				<div class="col-lg-3">
					<div class="wrap-article">
						<?=Html::img($article->extPage->getPrevLink(300,187),[
							'class'=>'article-img',
							'alt' => $article->title_page
						])?>
						<p class="article-title">
							<?=Html::a($article->title_page,$article->urlPage)?>
						</p>
						<p class="article-description">
							<?=$article->extPage->getShortContent()?>
						</p>
						<p class="article-date"><?=date('d.m.Y',$article->created_at)?> | <?=Html::a('Статья',$article->urlPage)?></p>
					</div>
				</div>
			<?php endforeach;?>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<p class="float-right article-link">
					<?=Html::a('Все акции',Pages::getUrlByLayout(Pages::LAYOUT_ACTIONS_LIST))?></p>
				<p class="h2">Акции</p>
			</div>
			<?php foreach($actions as $action):?>
				<div class="col-lg-3">
					<div class="wrap-article">
						<div class="actions-slider" id="<?=$id_slider?>">
							<?=Html::a(
								Html::img($action->extPage->getPrevLink(400,400),[
									'alt' => $action->title_page,
									'class' => 'action-img',
								]),
								$action->urlPage
							); ?>
						</div>
						<div class="actions-title">
							<?=Html::a(
								$action->title_page,
								$action->urlPage
							); ?>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		</div>
	</div>
</section>
