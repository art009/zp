<?php
use yii\helpers\Html;
?>

<div class="row">
    <?php foreach ($images as $image):?>
        <div class="col-md-4 col-xs-12 gallery">
            <?=Html::a(Html::img($image->getThumbnail(300,300),['class' => 'img-thumbnail']),$image->urlImage,['data-fancybox'=>'gallery'])?>
        </div>
    <?php endforeach;?>
</div>
