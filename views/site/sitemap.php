<div class="container">
	<h1><?=$page->title_page;?></h1>
	<div class="row">
        <div class="col-6">
            <?= \app\widgets\MenuWidget\MenuWidget::widget([
                'view' => 'sitemap',
                'menu_id' => 2,
	            'encodeLabels' => false,

            ]); ?>
        </div>
        <div class="col-6">
            <?= \app\widgets\MenuWidget\MenuWidget::widget([
                'view' => 'sitemap',
                'menu_id' => 1,
	            'encodeLabels' => false,
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?= \app\widgets\SitemapWidget\SitemapWidget::widget(); ?>
        </div>
    </div>

    <?=$page->content;?>
</div>
<div class="clearfix"></div>

