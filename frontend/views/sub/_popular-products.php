<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

?>

<div class="white-area">

    <div class="catalog container">

        <h2>Популярные товары</h2>

        <div class="row horizontal-center">

            <?php foreach($popular_products as $product) { ?>

                <?php
                $images = ArrayHelper::index($product->productImages, 'order');
                ?>

                <div class="item col-xs-6 col-md-3 horizontal-center">
                    <div class="wrapper-1">
                        <div class="wrapper-2">
                            <div class="box">
                                <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>" title="<?= $product->productCategory->title ?> - <?= $product->title; ?>">
                                    <h3 class="vertical-center horizontal-center"><?= $product->title; ?></h3>
                                    <?php if($product->productOffer->title !== null) { ?>

                                        <div class="yellow-circle vertical-center horizontal-center" style="<?= $product->productOffer->title_style ?>">
                                            <?= $product->productOffer->title ?>
                                        </div>

                                    <?php } ?>

                                    <div class="image vertical-center horizontal-center">
                                        <?= Html::img('/uploads/product-images/thumb_' . $images[1]->image_url, [
                                            'alt' => 'Миниатюра: ' .  $product->title,
                                            'title' => $product->title
                                        ]) ?>
                                    </div>
                                    <div class="price vertical-center">
                                        <?php if($product->productOffer->price !== null) { ?>

                                            <div class="price-col vertical-center horizontal-left">
                                                <div class="price-offer vertical-center horizontal-center" style="<?= $product->productOffer->price_style ?>">
                                                    <?= $product->productOffer->price ?>
                                                </div>
                                            </div>
                                            <div class="price-col vertical-center horizontal-right">
                                                <div class="price-actual horizontal-right"><?= $product->price ?> руб.</div>
                                            </div>

                                        <?php } else { ?>

                                            <div class="price-actual horizontal-right"><?= $product->price ?> руб.</div>

                                        <?php } ?>
                                    </div>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>

    <div class="space-area"></div>

</div>
