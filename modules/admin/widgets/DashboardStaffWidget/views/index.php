<?php
    use yii\helpers\Html;
?>

<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-gray">
        <div class="inner">
            <h3><?=$count_person?></h3>

            <p>Сотрудников</p>
        </div>
        <div class="icon">
            <i class="fa fa-users"></i>
        </div>
        <?=Html::a('Новый сотрудник <i class="fas fa-plus"></i>',$url,[
            'class' => 'small-box-footer'
        ])?>
    </div>
</div>