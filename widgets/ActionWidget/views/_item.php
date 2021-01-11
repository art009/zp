<?php
use yii\helpers\Html;
?>

    <div class="article-thumbnail">
        <?=Html::a(
            Html::img($model->extPage->getPrevLink(400,400),['alt' => $model->title_page,'class'=>'img-thumbnail']),
            $model->urlPage
        ); ?>
    </div>
    <div class="article-link">
        <?=Html::a($model->title_page,$model->urlPage)?>
    </div>
