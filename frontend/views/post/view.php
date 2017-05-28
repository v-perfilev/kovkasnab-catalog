<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $post->meta_title;

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $post->meta_keywords
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $post->meta_description
], 'meta-description');

?>

<?= $this->render('/sub/_modal-contact', [
    'contact' => $contact,
]) ?>

    <div class="white-area">

    <div class="space-area"></div>

    <div class="post container">

        <h1><?= $post->title ?></h1>

        <div class="date row">
            <div class="col-md-offset-3 col-md-6 horizontal-right">
                <?= Yii::$app->formatter->asDatetime($post->created_at, "php:d.m.Y H:i"); ?>
            </div>
        </div>

        <?php if( isset($post->image_url)) { ?>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <?= Html::img('/uploads/post-images/' . $post->image_url, [
                        'class' => 'img-responsive',
                        'alt' => 'Фото: ' . $post->title,
                        'title' => $post->title
                    ]) ?>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="text col-xs-12 col-md-10 col-md-offset-1">

                <?= $post->lead_text ?>

                <?= $post->full_text ?>

            </div>
        </div>

    </div>

<?= $this->render('/sub/_popular-products', [
    'popular_products' => $popular_products,
]) ?>

<?= $this->render('/sub/_categories-parallax', [
    'image' => Url::toRoute(['/images/parallax-other.jpg']),
    'categories' => $categories,
]) ?>

<?= $this->render('/sub/_random-posts', [
    'random_posts' => $random_posts,
]) ?>