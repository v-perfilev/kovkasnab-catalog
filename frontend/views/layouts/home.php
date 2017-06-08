<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$this->registerCssFile(Url::toRoute(['/css/header-home.css']), ['depends' => ['frontend\assets\AppAsset']]);

$this->registerJs('


');
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/']],
        ['label' => 'Каталог', 'url' => ['/product/index']],
        ['label' => 'Статьи', 'url' => ['/post/index']],
        ['label' => 'Контакты', 'url' => ['/site/contacts']],
    ];
?>

<div class="menu-collapsed hidden-md hidden-lg">
    <?= Menu::widget([
        'options' => ['class' => ''],
        'items' => $menuItems,
        'linkTemplate' => '<a class="vertical-center horizontal-center" href="{url}">{label}</a>',
        'activeCssClass'=>'active',
    ]); ?>
</div>

    <div class="header header-home">
        <div class="container">
            <div class="row">

                <div class="col-xs-7 col-md-4 vertical-center">
                    <a class="logo vertical-center" href="/">
                        <?= Html::img(Url::toRoute(['/images/logo.png']), [
                            'class' => 'logo-dim img-responsive',
                            'alt' => 'Логотип магазина кованых элементов "Ковкаснаб"',
                            'title' => 'Кованые элементы "Ковкаснаб"'
                        ]) ?>
                        <?= Html::img(Url::toRoute(['/images/logo-home.png']), [
                            'class' => 'logo-bright img-responsive',
                            'alt' => 'Логотип магазина кованых элементов "Ковкаснаб"',
                            'title' => 'Кованые элементы "Ковкаснаб"'
                        ]) ?>
                        <div class="title hidden-xs hidden-sm">КОВКАСНАБ.РУ</div>
                    </a>
                </div>

                <div class="col-md-7 hidden-xs hidden-sm vertical-center horizontal-right">
                    <?= Menu::widget([
                        'options' => ['class' => 'header-menu'],
                        'items' => $menuItems,
                        'activeCssClass'=>'active',
                    ]); ?>
                </div>

                <div class="col-xs-5 col-md-1 vertical-center horizontal-right">
                    <a id="feadback-button" class="feedback" href="#"><i class="fa fa-envelope-o"></i></a>
                    <div id="burger-button" class=" hidden-md hidden-lg">
                        <span class="menu-global menu-top"></span>
                        <span class="menu-global menu-middle"></span>
                        <span class="menu-global menu-bottom"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $content ?>


    <div class="footer">
        <div class="container">
            <div class="row vertical-center">
                <div class="col-md-3">
                    © 2016 – 2017 | Ковкаснаб
                </div>

                <div class="col-md-3 col-md-offset-6">

                    <!-- Yandex.Metrika counter -->
                    <script type="text/javascript">
                        (function (d, w, c) {
                            (w[c] = w[c] || []).push(function() {
                                try {
                                    w.yaCounter39814740 = new Ya.Metrika({
                                        id:39814740,
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

                            if (w.opera == "[object Opera]") {
                                d.addEventListener("DOMContentLoaded", f, false);
                            } else { f(); }
                        })(document, window, "yandex_metrika_callbacks");
                    </script>
                    <noscript><div><img src="https://mc.yandex.ru/watch/39814740" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                    <!-- /Yandex.Metrika counter -->

                    <!-- Top100 (Kraken) Widget -->
                    <span id="top100_widget"></span>
                    <!-- END Top100 (Kraken) Widget -->

                    <!-- Top100 (Kraken) Counter -->
                    <script>
                        (function (w, d, c) {
                            (w[c] = w[c] || []).push(function() {
                                var options = {
                                    project: 4447728,
                                    element: 'top100_widget'
                                };
                                try {
                                    w.top100Counter = new top100(options);
                                } catch(e) { }
                            });
                            var n = d.getElementsByTagName("script")[0],
                                s = d.createElement("script"),
                                f = function () { n.parentNode.insertBefore(s, n); };
                            s.type = "text/javascript";
                            s.async = true;
                            s.src =
                                (d.location.protocol == "https:" ? "https:" : "http:") +
                                "//st.top100.ru/top100/top100.js";

                            if (w.opera == "[object Opera]") {
                                d.addEventListener("DOMContentLoaded", f, false);
                            } else { f(); }
                        })(window, document, "_top100q");
                    </script>
                    <noscript>
                        <img src="//counter.rambler.ru/top100.cnt?pid=4447728" alt="Топ-100" />
                    </noscript>
                    <!-- END Top100 (Kraken) Counter -->

                    <!--LiveInternet counter--><script type="text/javascript">
                    document.write("<a href='//www.liveinternet.ru/click' "+
                    "target=_blank><img src='//counter.yadro.ru/hit?t45.4;r"+
                    escape(document.referrer)+((typeof(screen)=="undefined")?"":
                    ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                    screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                    ";"+Math.random()+
                    "' alt='' title='LiveInternet' "+
                    "border='0' width='31' height='31'><\/a>")
                    </script><!--/LiveInternet-->


                </div>

                <div class="scroll-button vertical-center horizontal-center">
                    <?= Html::img(Url::toRoute(['/images/arrow_white.png']), [
                        'class' => 'arrow_white',
                    ]) ?>
                    <?= Html::img(Url::toRoute(['/images/arrow_gray.png']), [
                        'class' => 'arrow_gray',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
