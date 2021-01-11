<?php
    use yii\helpers\Html;
?>

<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?=$count_news?></h3>

            <p>Новостей</p>
        </div>
        <div class="icon">
            <i class="fa fa-newspaper-o"></i>
        </div>
        <?=Html::a('Добавить новость <i class="fas fa-plus"></i>',$url,[
            'class' => 'small-box-footer'
        ])?>
    </div>
</div>