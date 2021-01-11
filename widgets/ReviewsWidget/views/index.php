<?php
    use yii\helpers\Html;
    use app\helpers\Pages;
?>

<section class="reviews bg-red">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<p class="float-right reviews-link">
					<?=Html::a('Все отзывы',Pages::getUrlByLayout(Pages::LAYOUT_REVIES))?>
				</p>
				<p class="h2">Отзывы о нашей работе</p>
			</div>
		</div>
		<div class="row">
			<?php foreach ($reviews as $review):?>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-2">
							<img class="review-img" src="/img/no_avatar.jpg" alt="<?=$review->created_name?>">
						</div>
						<div class="col-10">
							<p class="review-content">
								<?=$review->review?>
							</p>
							<p class="review-creater"><?=$review->created_name?></p>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		</div>
		<div class="clearfix"></div>
		<div class="reviews-mobile-link">
			<?=Html::a('Все отзывы',Pages::getUrlByLayout(Pages::LAYOUT_REVIES))?>
		</div>
	</div>
</section>