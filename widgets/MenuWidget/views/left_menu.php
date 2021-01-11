<?php
use yii\helpers\ArrayHelper;

$icons = [
    'icon-mmc',
    'icon-ro',
    'icon-dmc',
    'icon-cs',
    'icon-sl',
    'icon-sgv',
    'icon-lic',
];
foreach ($params['items'] as $key => $item)
{
//    $params['items'][$key]['encode'] = false;

    $params['items'][$key]['label'] = $item['label'];
    $params['items'][$key]['template'] = '<a class="nav-link" href="{url}">{label}</a>';
}
$data = ArrayHelper::merge($params,[
    'encodeLabels' => false,
    'options' => [
        'class' => 'nav flex-column',
    ],
]);

?>
<!-- Fixed navbar -->
<?=\yii\widgets\Menu::widget($data);?>
