<aside>
	<div class="btn-close-mobile-menu">
		<a href="#" onclick="showMobileMenu(this,event)"><i class="fas fa-times"></i></a>
	</div>
    <?= app\widgets\MenuWidget\MenuWidget::widget([
//        'menu_id' => 6,
        'depth' => 3,
        'view' => 'left_menu',
        'itemOptions' => [
            'class' => 'nav-item'
        ],
        'linkTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
//	    'submenuTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
    ]);?>
</aside>