<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Кованые элементы и изделия из металла: купить, фото - Ковкаснаб';

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'кованые элементы, кованые изделия, кованые пики, кованые вензеля, заглушки, навершия основания, цветы, листья, шары, балясины, вставки, заклепки, накладки, художественный прокат'
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Купить кованые элементы для ворот, заборов, калиток, лестниц, поручней и готовые изделия художественной ковки по выгодным ценам! Магазин кованых элементов.'
], 'meta-description');

?>

<?= $this->render('/sub/_modal-contact', [
    'contact' => $contact,
]) ?>

<?= $this->render('/sub/_home-banner-parallax', [
    'image' => Url::toRoute(['/images/parallax-home.jpg']),
    'categories' => $categories,
]) ?>

<div class="white-area">
    
    <div class="space-area"></div>
    
    <div class="nika container">
        <div class="row">
            <div class="nika-text vertical-center col-md-6 col-md-offset-1">
                <a class="vertical-center" href="http://kuznya-nika.ru" target="_blank">
                    Принимаем заказы на изготовление кованых и сварных изделий
                </a>
            </div>
            <div class="col-md-4">
                <a class="vertical-center" href="http://kuznya-nika.ru" target="_blank">
                    <?= Html::img(Url::toRoute(['/images/logo-nika.png']), [
                        'class' => 'img-responsive',
                        'alt' => 'Логотип кузни "Ника-3"',
                        'title' => 'Кузня "Ника-3"'
                    ]) ?>
                </a>
            </div>
        </div>
    </div>
    
    <div class="space-area"></div>

</div>

<?= $this->render('/sub/_popular-products', [
    'popular_products' => $popular_products,
]) ?>

<div class="white-area">

    <div class="container">
        <div class="row">
            <div class="text col-md-10 col-md-offset-1">

                <h1>Кованые элементы и изделия</h1>

                <p>
                    <strong>Художественная  ковка</strong> пользуется всё больше популярностью и тому есть немало причин: изделия из металла с элементами художественной ковки – это не только красиво и престижно, но ещё долговечно и функционально. Ковка ассоциируется с роскошью, но на деле вполне доступна, и купить элементы ковки недорого можно в нашем магазине.
                </p>

                <p>
                    <strong>Коваными элементами</strong> можно облагородить такие элементы интерьера как мебель, люстры, лестницу, таким образом кардинальон изменив вид помещения.  Металлические конструкции с элементами ковки на участке у дома, такие как кованые ворота с забором, скамейки и фонари так же привлекают внимание и подчёркивают хороший вкус и достаток хозяев. Эффектно смотрятся входные группы, где перила, лестница и козырёк смотрятся в одном стиле. А кованые беседки - это прекрасное место как для уединённого отдыха, так и для посиделок с друзьями. Благодаря огромному выбору литых, кованых и штампованных элементов из металла, которые представлены в нашем магазине, Ваш дом никогда не будет похож на чей-либо другой!
                </p>

                <p>
                    Хотите, чтобы Ваш дом вызывал восторг гостей? Украсте его коваными элементами из "Ковкаснаб".
                </p>

            </div>
        </div>
    </div>

    <div class="space-area"></div>

</div>

<div class="gray-area">

    <div class="space-area"></div>

    <div class="how container">
        <div class="row">
            <div class="title col-md-2 col-md-offset-3 vertical-center horizontal-center">
                <h2>Как забрать?</h2>
            </div>
            <div class="item col-md-2 vertical-center horizontal-center">
                Самовывоз<br>
                <i class="fa fa-building"></i>
            </div>
            <div class="item col-md-2 vertical-center horizontal-center">
                Доставка ТК<br>
                <i class="fa fa-truck"></i>
            </div>
        </div>
    </div>

    <div class="space-area"></div>

</div>

<div class="red-area">

    <div class="space-area"></div>

    <div class="advantages container">
        <div class="row">
            <div class="item col-md-4 vertical-center horizontal-center">
                <div class="white-circle vertical-center horizontal-center">
                    <i class="fa fa-star"></i>
                </div>
                <p>
                    Мы сотрудничаем непосредственно с крупными заводами-производителями кованых элементов для того, чтобы сделать цены максимально доступными.
                </p>
            </div>
            <div class="item col-md-4 vertical-center horizontal-center">
                <div class="white-circle vertical-center horizontal-center">
                    <i class="fa fa-cog"></i>
                </div>
                <p>
                    “Ковкаснаб” – не просто торговая компания – у нас огромный опыт изготовления изделий с элементами художественной ковки, которым мы будем рады с Вами поделиться.
                </p>
            </div>
            <div class="item col-md-4 vertical-center horizontal-center">
                <div class="white-circle vertical-center horizontal-center">
                    <i class="fa fa-refresh"></i>
                </div>
                <p>
                    Мы постоянно работаем над расширением нашего ассортимента. В нашем магазине более 300 наименований кованых элементов и готовых кованых изделий.
                </p>
            </div>
        </div>
    </div>

    <div class="space-area"></div>

</div>

<div class="gray-area">

    <div class="space-area"></div>

    <div class="how container">
        <div class="row">
            <div class="title col-md-2 col-md-offset-2 vertical-center horizontal-center">
                <h2>Как оплатить?</h2>
            </div>
            <div class="item col-md-2 vertical-center horizontal-center">
                Наличные<br>
                <i class="fa fa-rub"></i>
            </div>
            <div class="item col-md-2 vertical-center horizontal-center">
                Пластиковая карта<br>
                <i class="fa fa-credit-card-alt"></i>
            </div>
            <div class="item col-md-2 vertical-center horizontal-center">
                Банковский перевод<br>
                <i class="fa fa-file-text"></i>
            </div>
        </div>
    </div>

    <div class="space-area"></div>

</div>

<?= $this->render('/sub/_categories-parallax', [
    'image' => Url::toRoute(['/images/parallax-home-bottom.jpg']),
    'categories' => $categories,
]) ?>

<?= $this->render('/sub/_random-posts', [
    'random_posts' => $random_posts,
]) ?>