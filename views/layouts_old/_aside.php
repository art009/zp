<aside class="col-md-4">
    <?= app\widgets\MenuWidget\MenuWidget::widget([
        'menu_id' => 2,
        'depth' => 3,
        'view' => 'left_menu',
        'itemOptions' => [
            'class' => 'nav-item'
        ],
        'linkTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
    ]);?>
</aside>