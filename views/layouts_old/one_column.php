<?php
use app\widgets\Alert;
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<?= Alert::widget() ?>
<?=$content?>

<?php $this->endContent(); ?>