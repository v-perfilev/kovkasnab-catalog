<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = 'Кованые элементы: каталог, купить, цена, фото – Ковкаснаб';

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'кованые элементы, элементы художественной ковки, ковка, литьё, штамповка, цены, характеристики, фото, ковкаснаб'
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Каталог кованых элементов. Кованые элементы для ворот, заборов, лестниц, перил и других изделий художественной ковки. Цены, характеристики и фото.'
], 'meta-description');


$this->params['breadcrumbs'][] = ['label' => 'Каталог'];

?>

<?= $this->render('/sub/_modal-contact', [
    'contact' => $contact,
]) ?>

<?= $this->render('/sub/_categories-parallax', [
    'image' => Url::toRoute(['/images/parallax-catalog.jpg']),
    'categories' => $categories,
]) ?>

    <div class="white-area">

    <div class="space-area"></div>

    <div class="catalog catalog-categories main-catalog container">

        <div class="breadcrumb">
            <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]) ?>
        </div>

        <h1>Категории</h1>

        <div class="space-area"></div>

        <div class="row horizontal-center">

            <?php foreach($categories as $category) { ?>

                <div class="item col-xs-6 col-sm-3 col-md-2 horizontal-center">
                    <div class="wrapper-1">
                        <div class="wrapper-2">
                            <div class="box">
                                <a href="<?= Url::to(['product/category', 'slug' => $category->slug]); ?>" title="Категория - <?= $category->title; ?>">
                                    <h3 class="vertical-center horizontal-center"><?= $category->title; ?></h3>

                                    <?php if(isset($category->image_url)) { ?>
                                        <div class="image vertical-center horizontal-center">
                                            <?= Html::img('/uploads/category-images/thumb_' . $category->image_url, [
                                                'alt' => 'Миниатюра: ' .  $category->title,
                                                'title' => $category->title
                                            ]) ?>
                                        </div>
                                    <?php } ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>

<?= $this->render('/sub/_popular-products', [
    'popular_products' => $popular_products,
]) ?>

<?= $this->render('/sub/_random-posts', [
    'random_posts' => $random_posts,
]) ?>