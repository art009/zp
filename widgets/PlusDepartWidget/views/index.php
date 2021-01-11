<?php
use yii\helpers\Html;
?>

<div class="row row-padding-10">
	<?php foreach ($services as $item):?>
		<div class="col-md-6 col-xs-12">
			<div class="box-service">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12 text-center mt-3 box-service-icon">
						<i class="<?=$item->icon?> fa-5x"></i>
					</div>

					<div class="col-md-9 col-sm-9 col-xs-12">
						<h3><?=Html::a( $item->title,$item->link,[
								'title' => $item->title
							])?></h3>

						<p><?=$item->content?></p>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach;?>

</div>