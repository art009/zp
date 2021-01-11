<?php
use app\widgets\SignInWidget\SignInWidget;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \budyaga\users\models\forms\LoginForm */

$this->title = 'Вход в личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row justify-content-lg-center mt-4">
        <div class="col-lg-6 col-xs-12">
            <h1><?=$this->title?></h1>
            <?= SignInWidget::widget()?>
        </div>
    </div>
</div>