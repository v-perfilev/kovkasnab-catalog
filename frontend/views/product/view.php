<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = $product->meta_title;

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $product->meta_keywords
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $product->meta_description
], 'meta-description');

$this->registerJs(
    '$(document).ready(function(){
        $(".preview-image img").click( function() {

            id = this.id.split("-")[2];

            $(".preview-image img").removeClass("active");
            $(".full-image img").removeClass("active");

            $("#preview-image-"+id).addClass("active");
            $("#full-image-"+id).addClass("active");
        });
    });'
);

?>

<?= $this->render('/sub/_modal-contact', [
    'contact' => $contact,
]) ?>

<?= $this->render('/sub/_categories-parallax', [
    'image' => Url::toRoute(['/images/parallax-catalog.jpg']),
    'categories' => $categories,
]) ?>

<?php
    $images = ArrayHelper::index($product->productImages, 'order');
?>

    <div class="white-area">

        <div class="space-area"></div>

        <div class="product container">

            <h1><?= $product->title ?></h1>

            <div class="row">

                <div class="col-md-4">

                    <div class="full-image">
                        <div class="wrapper">
                            <?php
                            $i=0;
                            foreach( $images as $image )
                            {
                                if ($i==0) {
                                    ?>
                                    <?= Html::img('/uploads/product-images/' . $image->image_url, [
                                        'id' => 'full-image-'.$image->id,
                                        'class' => 'active img-responsive',
                                        'alt' => 'Фото: ' .  $product->title . ' ' . $image->id,
                                        'title' => $product->title
                                    ]) ?>

                                <?php } else { ?>

                                    <?= Html::img('/uploads/product-images/' . $image->image_url, [
                                        'id' => 'full-image-'.$image->id,
                                        'class' => 'img-responsive',
                                        'alt' => 'Фото: ' .  $product->title . ' ' . $image->id,
                                        'title' => $product->title
                                    ]) ?>

                                    <?php
                                }
                                $i++;
                            }
                            ?>
                        </div>
                    </div>

                    <div class="preview-images row">
                        <?php
                        $i=0;
                        foreach( $images as $image )
                        {
                            ?>
                            <div class="preview-image col-xs-3">
                                <div class="wrapper">
                                    <?php
                                    if ($i==0) {
                                        ?>
                                        <?= Html::img('/uploads/product-images/thumb_' . $image->image_url, [
                                            'id' => 'preview-image-'.$image->id,
                                            'class' => 'active img-responsive',
                                            'alt' => 'Миниатюра: ' .  $product->title . ' ' . $image->id,
                                            'title' => $product->title
                                        ]) ?>

                                    <?php } else { ?>

                                        <?= Html::img('/uploads/product-images/thumb_' . $image->image_url, [
                                            'id' => 'preview-image-'.$image->id,
                                            'class' => 'img-responsive',
                                            'alt' => 'Миниатюра: ' .  $product->title . ' ' . $image->id,
                                            'title' => $product->title
                                        ]) ?>

                                        <?php
                                    }
                                    $i++;
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>


                </div>

                <div class="col-md-8">

                    <div class="row">

                        <div class="table-container">
                            <table class="table table-striped table-active">
                                <tbody>
                                <tr class="price">
                                    <td class="first">Цена:</td>
                                    <td class="second"><?= $product->price ?> руб.</td>
                                </tr>
                                <tr>
                                    <td class="first">Категория:</td>
                                    <td class="second"><?= $product->productCategory->title ?></td>
                                </tr>
                                <tr>
                                    <td class="first">Артикул:</td>
                                    <td class="second"><?= $product->vendor ?></td>
                                </tr>
                                <tr>
                                    <td class="first">Вес:</td>
                                    <td class="second"><?= $product->weight ?> кг</td>
                                </tr>
                                <tr>
                                    <td class="first">Размер:</td>
                                    <td class="second"><?= $product->size ?> мм</td>
                                </tr>

                                <?php
                                if (!empty($productFeatures))
                                    foreach($productFeatures as $f) { ?>
                                        <tr>
                                            <td class="first"><?= $f[0] ?>:</td>
                                            <td class="second"><?= $f[1] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="text">
                            <?= $product->text ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

<?= $this->render('/sub/_popular-products', [
    'popular_products' => $popular_products,
]) ?>

<?= $this->render('/sub/_random-posts', [
    'random_posts' => $random_posts,
]) ?>