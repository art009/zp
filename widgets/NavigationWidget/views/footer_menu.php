<?=\yii\widgets\Menu::widget([
    'options' => ['class' => 'footer-links'],
    'items' => $items,
    'itemOptions' => [
        'onclick' => 'selectCategory(this,event)',
    ],
]);?>