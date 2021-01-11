<?php
/* @var $this yii\web\View */
?>

<?= dmstr\widgets\Alert::widget(); ?>

<?=$this->registerJs('
setTimeout(function(){
    $(".modal").modal("hide");
    $(".modal-body").html("<p>Загрузка данных&hellip;</p>");
}, 3000);
');?>
