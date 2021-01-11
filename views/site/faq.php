<?php
use app\widgets\ReviewsWidget\FaqWidget;
use yii\helpers\Html;
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1><?=$page->title_page;?></h1>
		</div>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-3 col-12">    <?=Html::a('Задать вопрос','#q-form',[
						'onclick' => 'scrollTo(this,event)',
						'class' => 'btn btn-feedback',
					])?>
				</div>
			</div>
			<?=FaqWidget::widget()?>
			<?=$page->content;?>
		</div>
	</div>
</div>
