<?php
    use yii\helpers\Html;
?>

<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?=$count_users?></h3>

            <p>Пользователей</p>
        </div>
        <div class="icon">
            <i class="fa fa-user"></i>
        </div>
        <?=Html::a('Новый пользователь <i class="fas fa-plus"></i>',$url,[
            'class' => 'small-box-footer'
        ])?>
    </div>
</div>