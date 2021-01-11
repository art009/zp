<?php
use yii\helpers\ArrayHelper;
$data = ArrayHelper::merge($params,[
	'encodeLabels' => false,
	'options' => [
		'class' => 'center-block',
	]
]);
?>

<?=\yii\widgets\Menu::widget($data);?>

