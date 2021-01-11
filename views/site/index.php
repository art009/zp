<main role="main">
	<?= \app\widgets\DepartsWidget\DepartsWidget::widget() ?>

	
<?= app\widgets\NewsWidget\NewsWidget::widget([
		'on_main' => true,
		'view' => 'section_news',
	]) ?>

	<section class="about-staff bg-blue mt-5">
		<div class="container">
			<p class="h2">Слово профессионалов</p>

			<div class="row mt-4 mb-4">
				<div class="col-lg-2">
					<img class="staff-img" src="/uploads/pages/staff_001.png">
				</div>
				<div class="col-lg-10">
					<div class="staff-title">Дети — наше будущее, и мы можем быть уверены в нем только, если они будут здоровы.</div>
					<div class="staff-description">
						<p>Очень важно, чтобы в ответственные моменты подготовки к появлению на свет, рождения и воспитания ребенка рядом с родителями были специалисты-профессионалы, которые бы разделили эту ответственность.</p>
						<p>Рождение ребенка – главное событие в жизни любой женщины, любой семьи.</p>
					</div>
					<img class="staff-modile-img" src="/uploads/pages/staff_001.png">
					<div class="staff-name">МАНЮХИНА<br/>ОКСАНА СТАНИСЛАВОВНА</div>
					<div class="staff-post">Генеральный директор Детского медицинского центра<br/>Родильного отделения</div>
				</div>
			</div>

			<hr class="mt-5 mb-2">

			<div class="row mt-4 mb-4">
				<div class="col-lg-2">
					<img class="staff-img" src="/uploads/pages/staff_002.jpg">
				</div>
				<div class="col-lg-10">
					<div class="staff-title">Первая коммерческая клиника в России, осуществляющая полный цикл медицинской помощи от планирования и ведения беременности, родов до патронажа новорожденных и диспансерного наблюдения детей до 18 лет.</div>
					<div class="staff-description">
						<p>В период беременности женщине требуется особо тщательный уход за полостью рта. «Здоровое поколение» - первая клиника, которая начала практиковать индивидуальный подход к лечению пациентов стоматологического профиля. Мы готовы отдать все наши знания и опыт, чтобы поддержать вас на каждом отрезке жизненного пути: от зачатия до рождения долгожданного малыша.</p>
					</div>
					<img class="staff-modile-img" src="/uploads/pages/staff_002.jpg">
					<div class="staff-name">ХАСПЕКОВА<br/> ЕЛЕНА АНАТОЛЬЕВНА</div>
					<div class="staff-post">Генеральный директор Центра эстетической и хирургической стоматологии<br/>Многопрофильного медицинского центра</div>
				</div>
			</div>

		</div>
	</section>

	<?= \app\widgets\ReviewsWidget\ReviewsWidget::widget([
		'on_main' => true
	])?>

	<?= \app\widgets\ArticlesWidget\ArticlesWidget::widget([
		'on_main' => true
	]) ?>
	
	<section class="branchs">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="h2">Наши филиалы</p>
				</div>
			</div>
			<div class="row filpad">
				<div class="col-lg-4">
					<div class="branch-map">
						<a href="/contacts.htm">
							<img src="/img/lest20.jpg"/>
						</a>
					</div>
					<div class="branch-name" style="font-size: 0.9em!important;">Многофункциональный медцентр <a href="tel:+74952255268">+7 (495) 225 52 68</a></div>
					<div class="branch-name">Детский центр <a href="tel:+74952255248">+7 (495) 225 52 48</a></div>
					<div class="branch-name">Стоматология <a href="tel:+74952255268">+7 (495) 225 52 68</a></div>
					<div class="branch-name">Косметология <a href="tel:+74952255248">+7 (495) 225 52 48</a></div>
					<div class="branch-phone"></div>
				</div>
				<div class="col-lg-4">
					<div class="branch-map">
						<a href="/contacts.htm">
							<img src="/img/rodilnoe.jpg"/>
						</a>
					</div>
					<div class="branch-name">Родильное отделение</div>
					<div class="branch-phone"><a href="tel:+74991372910">+7 (499) 137 29 10</a></div>
				</div>
				<div class="col-lg-4">
					<div class="branch-map">
						<a href="/contacts.htm">
							<img src="/img/lab.jpg"/>
						</a>
					</div>
					<div class="branch-name">Лаборатория</div>
					<div class="branch-phone"><a href="tel:+74952255268">+7 (495) 225 52 68</a></div>
				</div>
			</div>
			<hr class="mt-2">
		</div>
	</section>
</main>