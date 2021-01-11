<?php
use yii\helpers\ArrayHelper;
$data = ArrayHelper::merge($params,[
    'encodeLabels' => false,
    'options' => [
        'class' => 'list-unstyled row',
    ]
]);
?>

<?=\yii\widgets\Menu::widget($data);?>

