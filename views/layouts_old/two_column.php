<?php
use app\widgets\SidebarMenu\SidebarMenu;
use app\widgets\Alert;
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
    <!-- Begin page content -->
    <main role="main" class="container">
        <div class="row">
            <?=$this->render('_aside')?>
            <div class="col-md-8">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </main>

<?php $this->endContent(); ?>