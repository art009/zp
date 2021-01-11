<?php
namespace app\widgets\SitemapWidget;
use app\models\Pages;
use app\helpers\Pages as PagesHelper;
use yii\base\Widget;
use Yii;

class SitemapWidget extends Widget
{
    public function init()
    {
        $pages = Pages::find()
            ->leftJoin('menu', 'menu.page = pages.id')
            ->where(['AND',
                ['in','layout',array_keys( PagesHelper::getArrayLayout() )],
                ['status' => PagesHelper::STATUS_PUBLIC,
                'menu.page' => null],
            ])
            ->orderBy(['title_page' => SORT_ASC])
            ->all();
        $array_menu = [];
        foreach($pages as $page) {
            $array_menu[] = [
                'label' => $page->title_page,
                'url' => $page->getUrlPage(),
            ];
        }
        $params['items'] = $array_menu;
        echo $this->render('index',['params' => $params]);
    }
}
?>