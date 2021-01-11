<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a(
        '<span class="logo-mini">ЗП</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl,
        [
            'class' => 'logo',
            'target' => '_blank',
        ]
    ); ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" target="_blank" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <p class="navbar-text"><i class="fa fa-user"></i> <?=Yii::$app->user->identity->username;?></p>
                </li>
                <?php if (isset($this->params['right'])):?>
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
    </nav>
</header>
