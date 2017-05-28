<?php

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Статьи о художественной ковке – Ковкаснаб';

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'статьи о ковке, кованые изделия'
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Статьи о художественной ковке. Какие бывают кованые изделия, как их изготваливать и как за ними ухаживать?'
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

    <div class="posts container">

        <h1>Статьи</h1>


        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_item',
            'summary' => '',
        ]) ?>

    </div>

<?= $this->render('/sub/_popular-products', [
    'popular_products' => $popular_products,
]) ?>

<?= $this->render('/sub/_random-posts', [
    'random_posts' => $random_posts,
]) ?>