<?php
use yii\helpers\Html;
/* var $departs app/models/Depart*/

/* Список классов с фоновыми цветами
 * bg-green
 * bg-red
 * bg-dark-blue
 * bg-dark-grey
 * bg-green
 * bg-red
 * */
?>

<div class="wrapper flipper-widget">
	<div class="row mt-4">
		<?php foreach ($departs as $depart): ?>
			<div class="col-md-4 col-sm-12 pb-4" ontouchstart="this.classList.toggle('hover');">
				<div class="container" style="transform-style: preserve-3d;">
					<div class="front" style="background-image: url(<?=$depart->getImgLink()?>)">
						<div class="inner">
							<p class="depart-link d-xl-none">
								<?=Html::a($depart->name,['/site/depart','url'=>$depart->slug])?>
							</p>
							<div class="row d-xl-none links-mobile no-gutters mt-4">
								<div class="col text-left">
									<a class="depart-link" href="tel:<?=$depart->phone?>"><?=$depart->phone?></a>
								</div>
								<div class="col text-right">
									<?=Html::a('Записаться',['/site/contact-form'],[
										'onclick' => 'callContactForm(this,event)',
										'data-title' => 'Записаться к врачу: '.$depart->name,
									])?>
								</div>
							</div>



							<p class="depart-title d-none d-sm-block"><?=$depart->name?></p>

							<a class="depart-link d-none d-sm-block" href="tel:<?=$depart->phone?>"><?=$depart->phone?></a>
						</div>
					</div>
					<div class="back d-none d-sm-block">
						<div class="inner">
							<p>
								<?=Html::a('Записаться',['/site/contact-form'],[
									'onclick' => 'callContactForm(this,event)',
									'data-title' => 'Записаться к врачу: '.$depart->name,
								])?>
							</p>
							<p><?=Html::a('Услуги и цены',['/site/depart','url'=>$depart->slug])?></p>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach?>
	</div>
</div>

