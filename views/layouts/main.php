<?php

use app\helpers\Pages as HelperPages;
use yii\helpers\Html;
use app\assets\DunaevOnlineAsset;
use yii\widgets\Breadcrumbs;

DunaevOnlineAsset::register($this);
if (isset($_GET['page']))
    \Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => '/' . Yii::$app->request->pathInfo]);

app\widgets\ModalWindowWidget\ModalWindowWidget::widget();
?>

<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport"
			  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<?= Html::csrfMetaTags() ?>
		<link rel="icon" href="/favicon.ico">
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
		<?php if(!YII_DEBUG):?>
			<!-- Facebook Pixel Code -->
			<script>
		        !function(f,b,e,v,n,t,s) {if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		            n.queue=[];t=b.createElement(e);t.async=!0;
		            t.src=v;s=b.getElementsByTagName(e)[0];
		            s.parentNode.insertBefore(t,s)}(window, document,'script',
		            'https://connect.facebook.net/en_US/fbe...s.js');
		        fbq('init', '1033006756811737');
		        fbq('track', 'PageView');
			</script>
			<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1033006...pt=1" /></noscript>
			<!-- End Facebook Pixel Code -->
		<?php endif;?>
	</head>
	<body>
		<?php $this->beginBody() ?>
			<header class="bg-blue d-none d-xl-block">
				<div class="container">
					<div class="row no-gutters">
						<div class="col block-search">
							<i class="fas fa-search"></i> <a href="/search?query=">Поиск по сайту</a>
						</div>
						<div class="col">
							<i class="fas fa-map-marker-alt"></i>
							<?= Html::a('Как проехать?', HelperPages::getUrlByLayout(HelperPages::LAYOUT_CONTACT)) ?>
						</div>
						<div class="col">
							<i class="far fa-clock"></i>
							<?=Html::a('Время работы','/site/work-time',['onclick'=>'workTime(this,event)'])?>
						</div>
						<div class="col block-social">
							<a href="https://vk.com/medcentrmazp"><i class="fab fa-vk"></i></a>
							<a href="https://www.facebook.com/MedCentrMaZp/"><i class="fab fa-facebook-f"></i></a>
							<a href="https://www.instagram.com/medcentrmazp/"><i class="fab fa-instagram"></i></a>
							<a href="https://www.youtube.com/channel/UCp8Z-38A50rN7Q2-yQNdBlQ"><i class="fab fa-youtube"></i></a>
						</div>
						<div class="col block-visual">
							<i class="far fa-eye"></i> <a href="#" id="spec" class="bvi-open">Версия для слабовидящих</a>
						</div>
					</div>
				</div>
			</header>

			<section class="main-menu d-none d-md-block">
				<div class="container">
					<div class="row no-gutters mt-3">
						<div class="col-2">
							<a href="/"><img src="/img/logo.jpg" alt="Здоровое поколение" class="logo"></a>
						</div>
						<div class="col-10">
							<div class="row">
								<div class="col-12">
									<p class="h1 text-blue">Медицинская ассоциация "Здоровое поколение"</p>
									<p class="slogan">Первая частная семейная клиника. <b>Мы заботимся о вас с 1991 года.</b></p>
								</div>
							</div>
							<div class="row no-gutters mt-3">
								<div class="col-9">
									<?= \app\widgets\MenuWidget\MenuWidget::widget([
										'menu_id' => 5,
										'depth' => 2,
										'view' => 'main_vertical_v2',
										'itemOptions' => [
											'class' => 'list-item'
										],
										'options' => [
											'class' => 'list-unstyled row',
										],
										'linkTemplate' => '<a href="{url}">{label}</a>',
									])?>
								</div>
								<div class="col-3 text-right">
									<?=\yii\helpers\Html::a('<i class="fas fa-edit"></i> Задать вопрос',['/site/contact-form','goal'=>'submitFeedBack'],[
										'class' => 'query-form',
										'data-goal' => 'clickFeedBack',
										'data-title' => 'Напишите нам',
										'onclick' => 'callContactForm(this,event)'
									])?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="mobile-menu fixed-top d-block d-sm-none">
				<div class="container-fluid">
					<!--Navbar-->
					<nav class="navbar navbar-light mb-2">
						<!-- Navbar brand -->
						<a class="navbar-brand" href="/">Здоровое поколение</a>
						<p class="sloga">Первая частная семейная клиника.<br/><b>Мы заботимся о вас с 1991 года.</b></p>
						<!-- Collapse button -->
						<button class="navbar-toggler second-button" type="button" data-toggle="collapse" data-target="#mobile_menu"
								aria-controls="navbarSupportedContent23" aria-expanded="false" aria-label="Toggle navigation">
							<div class="animated-icon2"><span></span><span></span><span></span><span></span></div>
						</button>
						<!-- Collapsible content -->
						<div class="collapse navbar-collapse" id="mobile_menu">
							<!-- Links -->
							<?= \app\widgets\MenuWidget\MenuWidget::widget([
								'menu_id' => 5,
								'depth' => 2,
								'view' => 'main_vertical_v2',
								'itemOptions' => [
									'class' => 'nav-item'
								],
								'options' => [
									'class' => 'navbar-nav mr-auto',
								],
								'linkTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
							])?>
							<!-- Links -->
						</div>
						<!-- Collapsible content -->
					</nav>
					<!--/.Navbar-->
				</div>
			</section>

		<div class="container">
			<div class="row">
				<?php if(isset($this->params['breadcrumbs'])):?>
					<?= Breadcrumbs::widget([
						'links' => $this->params['breadcrumbs'],
					]) ?>
					<div class="btn-mobile-menu"><a href="#" onclick="showMobileMenu(this,event)"><i class="fas fa-chevron-left"></i> Меню</a></div>
				<?php endif?>
			</div>
		</div>

			<?= $content ?>
			<section class="contacts">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<p class="h2">Связь</p>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<p class="block-title">Написать сообщение</p>
							<div class="block-content">
								<?=\app\widgets\ReviewsWidget\ReviewsFormWidget::widget(['view' => 'form'])?>
							</div>
						</div>
						<div class="col-lg-3">
							<p class="block-title">Мы в фейсбук</p>
							<div class="block-content">
								<?php if( !defined(YII_DEBUG) && YII_DEBUG == false):?>
									<script>(function(d, s, id) {
											var js, fjs = d.getElementsByTagName(s)[0];
											if (d.getElementById(id)) return;
											js = d.createElement(s); js.id = id;
											js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.12';
											fjs.parentNode.insertBefore(js, fjs);
										}(document, 'script', 'facebook-jssdk'));</script>

									<div class="fb-page" data-href="https://www.facebook.com/MedCentrMaZp/" data-height="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
										<blockquote cite="https://www.facebook.com/MedCentrMaZp/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/MedCentrMaZp/">Медицинский центр  &quot;Здоровое поколение&quot;</a></blockquote>
									</div>
								<?php endif;?>
							</div>
						</div>
						<div class="col-lg-3">
							<p class="block-title">Мы в вконтакте</p>
							<div class="block-content">
								<?php if( !defined(YII_DEBUG) && YII_DEBUG == false):?>
									<script src="https://vk.com/js/api/openapi.js?153" type="text/javascript"></script>

									<div id="vk_widget">
										<div id="vk_groups"></div>
									</div>
									<script type="text/javascript">
										function VK_Widget_Init(){
											document.getElementById('vk_groups').innerHTML = "";
											var vk_width = document.getElementById('vk_widget').clientWidth;
											VK.Widgets.Group("vk_groups", {mode: 0, width: vk_width, height: "400", color1: "FFFFFF", color2: "2B587A", color3: "5B7FA6"}, 130030438);
										};
										window.addEventListener('load', VK_Widget_Init, false);
										window.addEventListener('resize', VK_Widget_Init, false);
									</script>
								<?php endif;?>

							</div>
						</div>
						<div class="col-lg-3">
							<p class="block-title">Мы в инстаграм</p>
							<div class="block-content">
								<?php if( !defined(YII_DEBUG) && YII_DEBUG == false):?>
									<iframe id="instagram_frame" src="https://averin.pro/widget.php?l=medcentrmazp&style=4&width=300&gallery=1&s=50&icc=3&icr=3&t=1&tt=Мы в Инстаграм&h=1&ttcolor=000000&th=ffffff&bw=ffffff&bscolor=FFFFFF&bs=3366ff&ts=Подписаться&ch=utf8" allowtransparency="true" frameborder="0" scrolling="no" style="border:none;overflow:hidden;width:100%; height: 430px" ></iframe>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<section id="slider-menu">
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col-md-auto">
						<?= \app\widgets\MenuWidget\MenuWidget::widget([
							'menu_id' => 10,
							'depth' => 1,
							'view' => 'slider_footer',
							'linkTemplate' => '<a href="{url}">{label}</a>',
						])?>

					</div>
				</div>
			</div>
		</section>

			<footer>
				<section class="content bg-grey">
					<div class="container">
						<div class="row">
							<div class="col-lg-4 col-sm-12">
								<div class="footer-title">Меню</div>
								<div class="footer-content">
									<?= \app\widgets\MenuWidget\MenuWidget::widget([
										'menu_id' => 3,
										'depth' => 1,
										'view' => 'main_footer',
										'itemOptions' => [
											'class' => 'list-item col-6 py-2'
										],
										'linkTemplate' => '<a href="{url}">{label}</a>',
									])?>

								</div>
								<hr class="hr-mobile">
							</div>
							<div class="col-lg-5 col-sm-12">
								<div class="footer-title">Информация</div>
								<div class="footer-content">
									Материалы, размещенные на данной странице, носят информационный характер и не являются публичной офертой.<br>
Получите консультацию специалистов по оказываемым медицинским услугам.
 
									
								</div>
								<hr class="hr-mobile">
							</div>
							<div class="col-lg-3 col-sm-12">
								<div class="footer-title">Контакты</div>
								<div class="footer-content">
									<p>
										<a href="/contacts.htm"><i class="fas fa-map-marker-alt"></i> Адреса и телефоны</a><br><br>

										<a href="https://vk.com/medcentrmazp"><i class="fab fa-vk"></i> </a>
										<a href="https://www.facebook.com/MedCentrMaZp/"><i class="fab fa-facebook-f"></i> </a>
										<a href="https://www.instagram.com/medcentrmazp/"><i class="fab fa-instagram"></i> </a>
										<a href="https://www.youtube.com/channel/UCp8Z-38A50rN7Q2-yQNdBlQ"><i class="fab fa-youtube"></i> </a>
									</p>

								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="copyright bg-dark-grey">
					<div class="container">
						<div class="row">
							<div class="col-lg-6">
								<p><?date('Y');?> © МА «Здоровое поколение»</p>
							</div>
							<div class="col-lg-6">
								<p class="links">
									<a href="https://www.z-p.ru/tos.htm">Политика конфиденциальности</a>
									<a href="https://www.z-p.ru/sitemap.htm">Карта сайта</a>
								</p>
							</div>
						</div>
					</div>
				</section>
			</footer>

		<?= $this->render('_modal'); ?>
		<?php $this->endBody() ?>
		<!-- Yandex.Metrika counter -->
		<script type="text/javascript" >
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(7736377, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true
            });
		</script>
		<noscript><div><img src="https://mc.yandex.ru/watch/7736377" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->
	</body>
</html>
<?php $this->endPage() ?>