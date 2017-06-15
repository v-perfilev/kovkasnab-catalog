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

        <h1>Условия обработки персональной информации</h1>

        <div class="text">

            

        </div>

    </div>

    <div class="space-area"></div>

</div>


<?= $this->render('/sub/_random-posts', [
    'random_posts' => $random_posts,
]) ?>