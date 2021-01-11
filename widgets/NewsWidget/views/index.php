<?php

use yii\helpers\Html;
use app\helpers\Pages;

/**
 * @property app\models\Pages $articles
 */
?>
<div class="main-widget-news">
    <div class="main-widget-title">Новости</div>
    <div class="row">
        <?php foreach ($news as $news_item):?>
            <div class="col-md-4 news-item">
                <div class="news-date"><?=date('d.m.Y',$news_item->created_at)?></div>
                <div class="news-title"><?=Html::a($news_item->title_page,$news_item->urlPage)?></div>
                <div class="news-description"><?=$news_item->extPage->getShortContent()?></div>
                <div class="news-link"><?=Html::a('Читать далее...',$news_item->urlPage)?></div>
            </div>
        <?php endforeach;?>

    </div>
    <div class="clearfix"></div>
    <div class="main-widget-wrap-link">
        <?=Html::a('все новости',Pages::getUrlByLayout(Pages::LAYOUT_NEWS_LIST))?>
    </div>
</div>
