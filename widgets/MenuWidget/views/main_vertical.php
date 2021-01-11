<?php
use yii\helpers\ArrayHelper;
$data = ArrayHelper::merge($params,[
    'encodeLabels' => false,
    'options' => [
        'class' => 'nav justify-content-center',
    ],
]);

?>
<!-- Fixed navbar -->
<nav class="navbar navbar-expand-md navbar-blue navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMain">
        <?=\yii\widgets\Menu::widget($data);?>
    </div>
</nav>