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

<section class="department">
	<div class="container mt-4">
		<div class="row">
			<?php foreach ($departs as $depart): ?>
				<div class="col-lg-4 mb-2">
					<div class="wrap-depart" style="background-image: url('<?=$depart->getImgLink()?>')">
						<div class="content">
							<p class="float-right">
								<?=Html::a('Записаться',['/site/contact-form'],[
									'onclick' => 'callContactForm(this,event)',
									'data-title' => 'Записаться к врачу: '.$depart->name,
								])?>
							</p>
							<p class="float-left phone">
								<a href="tel:<?=$depart->phone?>"><?=$depart->phone?></a>
							</p>
						</div>
					</div>
					<p class="title-depart">
						<?=Html::a($depart->name,['/site/depart','url'=>$depart->slug])?>
					</p>
				</div>
			<?php endforeach?>
		</div>
	</div>
</section>