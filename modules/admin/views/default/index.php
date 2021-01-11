<?php
use app\modules\admin\widgets\DashboardUserWidget\DashboardUserWidget;
use app\modules\admin\widgets\DashboardStaffWidget\DashboardStaffWidget;
use app\modules\admin\widgets\DashboardNewsWidget\DashboardNewsWidget;
use app\modules\admin\widgets\DashboardReviewsWidget\DashboardReviewsWidget;
$this->title = 'Панель управления';
?>
<div class="row">
    <?= DashboardUserWidget::widget();?>
    <?= DashboardStaffWidget::widget();?>
    <?= DashboardNewsWidget::widget();?>
</div>

<div class="row">
    <?= DashboardReviewsWidget::widget();?>
</div>