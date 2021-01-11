<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">

                <?= \cebe\gravatar\Gravatar::widget([
                    'email' => Yii::$app->params['adminEmail'],
                    'options' => [
                        'alt'   => Yii::$app->user->identity->username,
                        'class' => 'img-circle',
                    ],
                    'size' => 160
                ]); ?>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню управления', 'options' => ['class' => 'header']],
                    ['label' => 'Панель управления', 'icon' => 'fas fa-tachometer-alt', 'url' => ['/admin/default']],
                    [
                        'label' => 'Контент',
                        'icon' => 'far fa-folder',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Страницы', 'icon' => 'file', 'url' => ['/admin/pages'],],
                            ['label' => 'Новости', 'icon' => 'far fa-newspaper', 'url' => ['/admin/news'],],
                            ['label' => 'Акции', 'icon' => 'fas fa-snowflake', 'url' => ['/admin/actions'],],
                            ['label' => 'Статьи', 'icon' => 'far fa-id-card', 'url' => ['/admin/articles'],],
                            ['label' => 'Слайдер', 'icon' => 'far fa-images', 'url' => ['/admin/sliders'],],
                            ['label' => 'Вопросы', 'icon' => 'comments', 'url' => ['/admin/faq']],
                            ['label' => 'Отзывы', 'icon' => 'comments', 'url' => ['/admin/reviews']],
	                        ['label' => 'Услуги', 'icon' => 'gavel', 'url' => ['/admin/plus-depart']],
                            ['label' => 'Сотрудники', 'icon' => 'users', 'url' => ['/admin/staff']],
	                        ['label' => 'Прайс', 'icon' => 'fas fa-money-bill', 'url' => ['/admin/price']],
                        ],
                    ],
	                ['label' => 'Модальное окно', 'icon' => 'window-maximize', 'url' => ['/admin/modal-window']],
	                ['label' => 'Подразделения', 'icon' => 'address-card', 'url' => ['/admin/depart']],
                    ['label' => 'Меню', 'icon' => 'list', 'url' => ['/admin/menu']],
                    ['label' => 'Пользователи', 'icon' => 'users', 'url' => ['/admin/user']],
                    [
                        'label' => 'Выход',
                        'icon' => 'fas fa-sign-out-alt',
                        'url' => ['/site/logout'],
                        'visible' => !Yii::$app->user->isGuest,
                        'template' => '<a href="{url}" data-method="post">{icon} {label}</a>'
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
