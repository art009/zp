<?php
use yii\helpers\Html;
?>

<div id="<?=$id_slider?>" class="main-slider">
    <?php foreach ($slides as $key => $slide) {
		echo '<div>'.Html::a(Html::img($slide->getImgLink(),['alt' => $slide->name]), $slide->getLinkPage()).'</div>';
    }?>
</div>