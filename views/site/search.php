<?php

use yii\helpers\Html;
use app\helpers\Pages;

$this->title = ($pages == NULL)?'По вашему запросу ни чего не найдено':'По вашему запросу "'.Html::encode($query).'" найдено';
?>

<div class="container">
	<h1><?=$this->title;?></h1>

	<div class="row">
		<div class="col-lg-12">
			<form method="get" class="mb-4">
				<?php //= Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []);?>
				<div class="form-row">
					<div class="col-7">
						<input name="query" value="<?=Html::encode($query)?>" type="text" class="form-control" placeholder="Поиск...">
					</div>
					<div class="col">
						<button type="submit" class="btn btn-primary">Найти</button>
					</div>
				</div>
			</form>
		</div>
	</div>


	<div class="row">
		<div class="col-lg-12">
			<div class="body-content">
				<?php if ($pages != NULL):?>
					<?php foreach ($array_layout as $layout):?>
						<?php if($pages[$layout]) : ?>
							<p class="h5"><b>Раздел "<?=Pages::getFrontArrayLayout()[$layout]?>"</b></p>
							<?php foreach ($pages[$layout] as $page):?>
								<p class="h6"><?=Html::a($page->title_page,$page->getUrlPage(),[
										'data-id' => $page->id
									])?></p>
								<p class="description"><?=$page->getSearchContent($query)?></p>
							<?php endforeach;?>
						<?php endif;?>
					<?php endforeach;?>
				<?php else: ?>
					<p>По вашему запросу ни чего не найдено.</p>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>