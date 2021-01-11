<?php
use app\widgets\SidebarMenu\SidebarMenu;
use app\widgets\Alert;
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
	<!-- Begin page content -->
	<main role="main" class="container">
		<div class="row no-gutters">
			<div class="col-md-3">
				<?=$this->render('_aside')?>
			</div>
			<div class="col-md-9">
				<?= Alert::widget() ?>
				<?= $content ?>
			</div>
		</div>
	</main>

<?php $this->endContent(); ?>