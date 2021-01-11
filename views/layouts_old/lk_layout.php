<?php $this->beginContent('@app/views/layouts/main.php'); ?>

    <?= $this->render('_lk_menu');?>
    <?= $content ?>
<?php $this->endContent(); ?>
