<?php
use yii\helpers\Html;
?>

    <div class="article-thumbnail">
        <?php if($model->extPage):?>
            <?=Html::a(
                Html::img($model->extPage->getPrevLink(250,250),['alt' => $model->title_page,'class'=>'img-thumbnail']),
                $model->urlPage
            ); ?>
        <?php else:?>
            <?=Html::a(
                Html::img(Yii::getAlias('@web') .'/imgs/no-img.jpg',['alt' => $model->title_page,'class'=>'img-thumbnail']),
                $model->urlPage
            ); ?>
        <?php endif;?>
    </div>
    <div class="article-link">
        <?=Html::a($model->title_page,$model->urlPage)?>
    </div>
