<?php
use app\helpers\Reviews;
use yii\helpers\Html;
use app\helpers\Pages;

$this->params['breadcrumbs'][] = [
    'label' => 'Вопросы / Ответы',
    'url' => Pages::getUrlByLayout(Pages::LAYOUT_FAQ),
];
$this->params['breadcrumbs'][] = [
    'label' => Reviews::Categories()[$faq->category_id]
];
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1><?=Reviews::Categories()[$faq->category_id]?></h1>
		</div>

		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-3 col-12">    <?=Html::a('Задать вопрос','#q-form',[
						'onclick' => 'scrollTo(this,event)',
						'class' => 'btn btn-feedback',
					])?>
				</div>
			</div>

			<p><?=date('d.m.Y',$faq->created_at)?></p>
			<p><b>Вопрос от <?=Html::encode($faq->created_name)?>:</b> <?=Html::encode($faq->review)?></p>
			<p><b>Ответ:</b> <?=$faq->answer?></p>
		</div>
	</div>
</div>
