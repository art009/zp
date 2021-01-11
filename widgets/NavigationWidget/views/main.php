<?php
    use yii\helpers\Url;
    use yii\bootstrap\Nav;
?>

<nav id="main-menu" class="navbar navbar-green" role="navigation">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle pull-left" data-toggle="collapse-catalog" data-target="#bs-navbar-collapse-catalog">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="visible-xs-inline-block center-block">
                <a class="navbar-brand phone-code" href="tel:+79044906722">+7 (9044) 90-67-22</a>
            </div>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-main">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-navbar-collapse-main">

            <?=Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => $items,
            ]);?>

            <form class="navbar-form navbar-right" role="search" action="<?=Url::to('/search')?>">
                <div class="input-group">
                    <input name="query" type="text" class="form-control" <?=($_GET['query'])?'value="'.$_GET['query'].'"':''?>/>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div><!-- /input-group -->
            </form>
        </div><!-- /.navbar-collapse -->

</nav>