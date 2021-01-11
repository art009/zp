<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model budyaga\users\models\User */

$this->title = 'Добавление пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Список пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>