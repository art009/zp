<div id="bs-navbar-collapse-catalog" class="col-md-3 col-xs-12">
    <div class="wrap-sidebar">
        <div class="title-sidebar">Каталог</div>
        <div class="content-sidebar">
            <?=\yii\widgets\Menu::widget([
                'items' => $items,
                'encodeLabels' => false,
    //            'linkTemplate' => '{label}',
                'options' => [
                    'class' => 'sidebar-catalog',
                ],
            ]);?>
        </div>
    </div>
</div>