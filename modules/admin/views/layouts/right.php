<?php
use yii\bootstrap\Tabs;

?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <?=Tabs::widget([
        'items' => $tabs,
        'encodeLabels' => false,
        'options' => [
            'class' => 'nav nav-tabs nav-justified control-sidebar-tabs',
        ],
    ]);?>
</aside>
<!-- /.control-sidebar -->
<div class="control-sidebar-bg"></div>