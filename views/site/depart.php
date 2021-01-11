<?php
/**
 * @var $page \app\models\Pages
 * */
use yii\helpers\Html;
use app\widgets\SliderWidget\SliderWidget;
use app\widgets\GalleryWidget\GalleryWidget;
use app\widgets\StaffWidget\StaffWidget;

$this->params['breadcrumbs'][] = $page->title_page;
?>

<h1><?=$page->title_page;?></h1>
<?= SliderWidget::widget(); ?>

<?=app\widgets\PlusDepartWidget\PlusDepartWidget::widget([
	'depart_id' => $page->depart->id
])?>

<div class="row">
	<div class="col-lg-12">
		<?php if($page->extPage && $page->extPage->image):?>
			<?= Html::img($page->extPage->getMainImageUrl(),['class' => 'news-thumbnail'])?>
		<?php endif;?>
		<?=$page->content;?>

		<?=StaffWidget::widget(['page' => $page->id,]);?>

	</div>
</div>