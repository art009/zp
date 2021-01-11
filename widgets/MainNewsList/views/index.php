<?php

use yii\helpers\Html;

/**
 * @property app\models\Pages $articles
 */
?>
<p class="h3">Последние новости</p>

<div class="row">

    <?php foreach ($news as $item):?>
        <div class="col-md-3 col-xs-12">
            <div class="item-news">
                <div class="news-wrap-img">
                    <?=
                    Html::a(
                        Html::img($item->extPage->coverUrl,['class' => 'img-responsive center-block']),
                        $item->urlPage,
                        ['class' => 'thumbnail']
                    ); ?>
                </div>
                <div class="news-link">
                    <?=Html::a($item->title_page,$item->urlPage)?>
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>
