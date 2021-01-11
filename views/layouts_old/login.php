<?php
use app\widgets\Alert;
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <?= Alert::widget() ?>

            <?=$content?>
        </div>
    </div>

<?php $this->endContent(); ?>