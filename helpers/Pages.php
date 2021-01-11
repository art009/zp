<?php
namespace app\helpers;

class Pages
{
    const LAYOUT_MAIN           = 10;
    const LAYOUT_PAGE           = 20;
    const LAYOUT_CONTACT        = 30;
    const LAYOUT_NEWS_LIST      = 40;
    const LAYOUT_ARTICLE_LIST   = 50;
    const LAYOUT_NEWS           = 60;
    const LAYOUT_ARTICLE        = 70;
    const LAYOUT_STAFF          = 80;
    const LAYOUT_REVIES         = 90;
    const LAYOUT_FAQ            = 100;
    const LAYOUT_ACTIONS_LIST   = 110;
    const LAYOUT_ACTION         = 120;
    const LAYOUT_WORKER         = 130;
    const LAYOUT_SITEMAP        = 140;
	const LAYOUT_DEPART         = 150;
	const LAYOUT_TABS           = 160;

    const STATUS_PUBLIC     = 10;
    const STATUS_BLOCK      = 20;
    const STATUS_ARСHIVE    = 30;

    /**
     * Список статусов страниц
     * @return array
     */
    public static function getArrayStatus()
    {
        return [
            self::STATUS_PUBLIC     => 'Опубликовано',
            self::STATUS_ARСHIVE    => 'Архив',
            self::STATUS_BLOCK      => 'Блокировано',
        ];
    }

    /**
     * Лейбл статуса по id
     * @param integer $id
     * @return string
     */
    public static function getLabelStatus ($id)
    {
        return self::getArrayStatus()[$id];
    }

    /**
     * Cписок доступных шаблонов для раздела страниц
     * @return array
     */
    public static function getArrayLayout()
    {
        return [
            self::LAYOUT_PAGE           => 'Статическая страница',
            self::LAYOUT_MAIN           => 'Главная',
	        self::LAYOUT_DEPART         => 'Подразделение',
            self::LAYOUT_CONTACT        => 'Контакты',
            self::LAYOUT_NEWS_LIST      => 'Список новостей',
            self::LAYOUT_ARTICLE_LIST   => 'Список статей',
            self::LAYOUT_ACTIONS_LIST   => 'Список акций',
            self::LAYOUT_STAFF          => 'Список сотрудников',
            self::LAYOUT_REVIES         => 'Список всех отзывов',
            self::LAYOUT_FAQ            => 'Список всех вопросов',
            self::LAYOUT_SITEMAP        => 'Карта сайта',
	        self::LAYOUT_TABS           => 'Страница с табами',
        ];
    }

    public static function getFrontArrayLayout()
    {
        return [
            self::LAYOUT_PAGE       => 'Страниц',
            self::LAYOUT_NEWS       => 'Новостей',
            self::LAYOUT_ARTICLE    => 'Статей',
            self::LAYOUT_WORKER     => 'Сотрудников',
        ];
    }
    /**
     * Поный список файлов с шаблонами
     * @return array
     */
    public static function getArrayLayoutName()
    {
        return [
            self::LAYOUT_PAGE       => 'page',
            self::LAYOUT_MAIN       => 'index',
            self::LAYOUT_CONTACT    => 'contact',
            self::LAYOUT_NEWS_LIST  => 'news_list',
            self::LAYOUT_ARTICLE_LIST   => 'article_list',
            self::LAYOUT_ACTIONS_LIST   => 'action_list',
            self::LAYOUT_NEWS       => 'news',
            self::LAYOUT_ARTICLE    => 'article',
            self::LAYOUT_STAFF      => 'staff',
            self::LAYOUT_REVIES     => 'reviews',
            self::LAYOUT_FAQ        => 'faq',
            self::LAYOUT_ACTION     => 'action',
            self::LAYOUT_WORKER     => 'worker',
            self::LAYOUT_SITEMAP    => 'sitemap',
	        self::LAYOUT_DEPART     => 'depart',
	        self::LAYOUT_TABS       => 'tabs_page',
        ];
    }

    /**
     * Лейбл шаблона по id
     * @param integer $id
     * @return string
     */
    public static function getLabelLayout ($id)
    {
        return self::getArrayLayout()[$id];
    }

    /**
     * Возвращаем ссылку на страницу по названию шаблона
     * @param string $layout
     * @return string
     */
    public static function getUrlByLayout ($layout)
    {
        $url = '#';
        $page = \app\models\Pages::findOne([
            'layout' => $layout,
            'status' => self::STATUS_PUBLIC
        ]);

        if ($page)
            $url = $page->getUrlPage();
//	    if($layout == self::LAYOUT_NEWS_LIST){var_dump($url);exit;}
        return $url;
    }
}