<?php
use yii\helpers\Html;
?>

    <div class="review-content">
        <div class="review-date"><?=date('d.m.Y',$model->created_at);?></div>
        <?=Html::a('<b>Вопрос от ' . $model->created_name . ':</b>',['/site/faq-views','id' => $model->id])?>
        <?=$model->review?>
    </div>
    <div class="review-content"><b>Ответ:</b> <?=$model->answer?></div>
<hr/>