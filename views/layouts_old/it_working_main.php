<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\SpecialAsset\SpecialAsset;
use \app\helpers\Pages as HelperPages;

AppAsset::register($this);
SpecialAsset::register($this);
if (isset($_GET['page']))
    \Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => '/'.Yii::$app->request->pathInfo]);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <?= Html::csrfMetaTags() ?>
    <link rel="icon" href="/favicon.ico">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div class="container">
    <div id="top-line" class="container">
    <div class="row">
        <div id="place-block" class="col-lg-4 col-sm-12">
            <p class="text-center"><i class="icon icon-place"></i> <?=Html::a('г. Москва, ул. Лестева, д.20',HelperPages::getUrlByLayout(HelperPages::LAYOUT_CONTACT))?></p>
        </div>
        <div id="time-block" class="col-lg-4 col-sm-12">
            <p class="text-center"><i class="icon icon-time"></i> <?=Html::a('Время работы центров','/site/work-time',['onclick'=>'workTime(this,event)'])?></p>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div id="wrap-search-form">
                <form class="text-right" action="<?=Yii::$app->urlManager->createUrl(['/site/search'])?>" method="GET">
                    <button class="btn-search" type="submit"><i class="icon icon-search"></i></button>
                    <input class="text-search" name="query" type="text" placeholder="Поиск по сайту" aria-label="Поиск по сайту" value="<?=isset($_GET['query'])?$_GET['query']:''?>">
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-5 col-12 d-none d-sm-block">
            <a href="/"><img class="logo" src="/imgs/logo.png" alt="Здоровое поколение медицинская ассоциация"></a>

            <div class="about">
                <div class="name">"Здоровое поколение" медицинская ассоциация</div>
                <div class="description">Первая частная семейная клиника<br/><b>Мы заботимся о вас с 1991 года</b></div>
            </div>
        </div>
        <div class="col-lg-5 deport-list">
            <div class="row">
                <div class="col-5">многопрофильный медицинский центр стоматология</div>
                <div class="col-7 text-right">
                    <b>+7 (495) 225 52 68</b><br/>
                    <?=Html::a('Записаться',['/site/contact-form'],['class'=> 'maa-link','data-title'=>'Записаться к врачу','onclick'=>'callContactForm(this,event)'])?><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-5">детский медицинский центр</div>
                <div class="col-7 text-right"><b>+7 (495) 225 52 48</b></div>
            </div>
            <div class="row">
                <div class="col-5">родильное отделение</div>
                <div class="col-7 text-right"><b>+7 (499) 137 29 10</b></div>
            </div>
        </div>
        <div class="col-lg-2 col-12">
		 <div style="text-align: right;">
            <!--<div class="contact-name">Администрация клиники</div>-->
            <?=Html::a('Обратная связь',['/site/contact-form'],['class'=> 'feedback-link','data-title'=>'Напишите нам','onclick'=>'callContactForm(this,event)'])?><br/>

            <div class="header-social">
                <noindex>
                    <a target="_blank" href="http://vk.com/zpokolenie"><img src="/imgs/social_vk.png"/></a>
                    <a target="_blank" href="https://www.facebook.com/ma.zdorovoepokolenie"><img src="/imgs/social_fb.png"/></a>
                    <a target="_blank" href="https://www.instagram.com/medcentrmazp/"><img src="/imgs/social_inst.png"/></a>
                    <a target="_blank" href="https://www.youtube.com/channel/UCp8Z-38A50rN7Q2-yQNdBlQ"><img src="/imgs/social_youtube.png"/></a>
                </noindex>
            </div>
		 </div>	
        </div>
    </div>
</div>

<div class="container">
    <?= app\widgets\MenuWidget\MenuWidget::widget([
        'menu_id' => 1,
        'depth' => 1,
        'view' => 'main_vertical',
        'itemOptions' => [
            'class' => 'nav-item'
        ],
        'linkTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
    ]);?>
</div>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</div>
<?=$content?>

<div class="container">

    <div class="main-widget-deports">
        <div class="main-widget-title">Наши филиалы</div>
        <div class="row">
            <div class="col-md-4">
                <div class="depart-item">
                    <div class="deport-map">
                        <a href="https://www.google.ru/maps/place/%D1%83%D0%BB.+%D0%9B%D0%B5%D1%81%D1%82%D0%B5%D0%B2%D0%B0,+20,+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0/@55.714892,37.610076,17z/data=!3m1!4b1!4m2!3m1!1s0x46b54b6b9b09f853:0xbb64e121c13ccf36"><img src="/imgs/Lesteva20.jpg"/></a>
                    </div>
                    <div class="deport-title">Многопрофильный медицинский центр Стоматология</div>
                    <div class="deport-phone">+7 (495) 225 52 68</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="depart-item">
                    <div class="deport-map">
                        <a href="https://www.google.ru/maps/place/%D1%83%D0%BB.+%D0%9B%D0%B5%D1%81%D1%82%D0%B5%D0%B2%D0%B0,+20,+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0/@55.714892,37.610076,17z/data=!3m1!4b1!4m2!3m1!1s0x46b54b6b9b09f853:0xbb64e121c13ccf36"><img src="/imgs/Lesteva20.jpg"></a>
                    </div>
                    <div class="deport-title">Детский медицинский центр</div>
                    <div class="deport-phone">+7 (495) 225 52 48</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="depart-item">
                    <div class="deport-map"><a href="https://www.google.ru/maps/place/%D0%A4%D0%BE%D1%82%D0%B8%D0%B5%D0%B2%D0%BE%D0%B9+%D1%83%D0%BB.,+6,+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0/@55.701753,37.563137,17z/data=!3m1!4b1!4m2!3m1!1s0x46b54c841475d615:0xcffb978b68645aa7"><img src="/imgs/Fotievoy6.jpg"/></a></div>
                    <div class="deport-title">Родильное отделение</div>
                    <div class="deport-phone">+7 (499) 137 29 10</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row social-wrap">
        <div class="col-md-4">
            <div id="q-form" class="social-title title-q">Оставить отзыв/задать вопрос</div>
            <div class="feedback-form">
                <?=\app\widgets\ReviewsWidget\ReviewsFormWidget::widget(['view' => 'form'])?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="social-title title-vk">Мы в вконтакте</div>
            <div class="social-content"><?= $this->render('_social_vk');?></div>
        </div>
        <div class="col-md-4">
            <div class="social-title title-fb">Мы в Facebook</div>
            <div class="social-content">
                <?= $this->render('_social_fb');?>
            </div>
        </div>
    </div>
    <div class="row main-widget-footer">
        <div class="col-md-4">
            <div class="main-widget-footer-title">Услуги</div>
            <div class="main-widget-footer-content">
                <?= app\widgets\MenuWidget\MenuWidget::widget([
                    'menu_id' => 3,
                    'depth' => 1,
                    'view' => 'main_footer',
                ]);?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="main-widget-footer-title">Информация</div>
            <div class="main-widget-footer-content">
                <p>Необходимо проконсультироваться с врачом Вся информация на сайте является справочной и не является открытой офертой</p>
                <p>Перед применением проконсультируйтесь со специалистом. Политика компании в отношении <a href="#">обработки персональных данных</a></p>
            </div>


        </div>
        <div class="col-md-4">
            <div class="main-widget-footer-title">Контакты</div>
            <div class="main-widget-footer-content contacts">
                <span class="col-md-6">пн-сб - 9.00-20.00</span>
                <span class="col-md-6">+7 (495) 225-52-68</span><br/>
                <span class="col-md-6">вск. - 10.00-16.00</span>
                <span class="col-md-6"><a href="mailto:mailbox@z-p.ru">mailbox@z-p.ru</a></span>
                <br/>
                <br/>
                <noindex>
                    <a target="_blank" href="http://vk.com/zpokolenie"><img src="/imgs/social_vk.png"/></a>
                    <a target="_blank" href="https://www.facebook.com/ma.zdorovoepokolenie"><img src="/imgs/social_fb.png"/></a>
                    <a target="_blank" href="https://www.instagram.com/medcentrmazp/"><img src="/imgs/social_inst.png"/></a>
                    <a target="_blank" href="https://www.youtube.com/channel/UCp8Z-38A50rN7Q2-yQNdBlQ"><img src="/imgs/social_youtube.png"/></a>
                </noindex>
                <br/>
                <br/>
                design&support <a href="http://Dunaev.online">Dunaev.online</a>
            </div>

        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <span class="text-center">2018 © Медцентр «Здоровое поколение»</span>
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter7736377 = new Ya.Metrika({
                            id:7736377,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true,
                            webvisor:true
                        });
                    } catch(e) { }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";
=                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
            })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/7736377" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
    </div>
</footer>
<?= $this->render('_modal');?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
