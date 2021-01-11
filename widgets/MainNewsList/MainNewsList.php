<?php
namespace app\widgets\MainNewsList;

use yii\base\Widget;
use app\models\Pages;
use app\helpers\Pages as PagesHelper;

class MainNewsList extends Widget
{
    public $show = 4;
    public function run()
    {
        $news = Pages::find()->where([
            'status' => PagesHelper::STATUS_PUBLIC,
            'layout' => PagesHelper::LAYOUT_NEWS,
        ])
            ->limit($this->show)
            ->orderBy('created_at DESC')
            ->all();
        if ($news)
            return $this->render('index',['news' => $news]);
    }

    public function init()
    {
        return parent::init();
    }
}