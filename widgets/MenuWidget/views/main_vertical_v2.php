<?php
use yii\helpers\ArrayHelper;
$data = ArrayHelper::merge($params,[
	'encodeLabels' => false,
]); ?>

<?=\yii\widgets\Menu::widget($data);?>