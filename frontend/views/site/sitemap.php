<?php

use yii\helpers\Url;

$this->title = 'Магазин кованых элементов: телефон, адрес – Ковкаснаб';

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'контакты магазина кованых элементов, элементы художественной ковки, ковка, литьё, штамповка, цены, характеристики, фото, ковкаснаб'
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Магазин кованых элементов. Здесь можно купить элементы художественной ковки по доступным ценам! Контакты, номер телефона, адрес.'
], 'meta-description');

?>

<?= $this->render('/sub/_modal-contact', [
    'contact' => $contact,
]) ?>

<?= $this->render('/sub/_categories-parallax', [
    'image' => Url::toRoute(['/images/parallax-other.jpg']),
    'categories' => $categories,
]) ?>

<div class="white-area">

    <div class="space-area"></div>

    <div class="container">

        <h1>Карта сайта</h1>

            <div class="col-md-4 col-md-offset-1 text">
                <p>
                    <h3>Ковкаснаб</h3>
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><a href="/product">Каталог</a></li>
                        <li><a href="/contacts">Доставка и оплата</a></li>
                        <li><a href="/post">Статьи</a></li>
                        <li><a href="/about">О нас</a></li>
                        <li><a href="/contacts">Контакты</a></li>
                        <li><a href="/conditions">Условия обработки персональной информации</a></li>
                        <li><a href="/sitemap">Карта сайта</a></li>
                    </ul>
                </p>
            </div>

            <div class="col-md-4 col-md-offset-2 text">
                <p>
                <h3>Категории товаров</h3>

                <ul>

                    <?php foreach($categories as $category) { ?>

                        <li><a href="<?= Url::to(['product/category', 'slug' => $category->slug]); ?>" title="Категория - <?= $category->title; ?>"><?= $category->title; ?></a></li>

                    <?php } ?>

                </ul>
                </p>
            </div>

    </div>

    <div class="space-area"></div>

</div>


<?= $this->render('/sub/_random-posts', [
    'random_posts' => $random_posts,
]) ?>