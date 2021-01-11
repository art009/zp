<?php
/* @var $this yii\web\View */
/* @var $model app\models\Sliders */

$this->title = 'Новый слайдер';
$this->params['breadcrumbs'][] = ['label' => 'Управление слайдерами', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sliders-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
