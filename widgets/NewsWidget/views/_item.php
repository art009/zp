<?php
use yii\helpers\Html;
?>
<div class="news-thumbnail">
    <?=Html::a(
        Html::img($model->extPage->getPrevLink(250,250),['alt' => $model->title_page,'class'=>'img-thumbnail']),
        $model->urlPage
    ); ?>
</div>
<div class="news-link">
    <?=Html::a($model->title_page,$model->urlPage)?>
</div>