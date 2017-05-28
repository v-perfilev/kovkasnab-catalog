<?php

use yii\helpers\Url;

?>


<div class="parallax-area hidden-xs hidden-sm" data-parallax="scroll" data-image-src="<?= $image; ?>" data-speed="0.1">

    <div class="space-area"></div>

    <div class="categories container">

        <h2>Категории кованых элементов и изделий</h2>

        <div class="row horizontal-center">


            <?php foreach($categories as $category) { ?>

                <div class="item">
                    <a href="<?= Url::to(['product/category', 'slug' => $category->slug]); ?>" title="Категория - <?= $category->title; ?>">
                        <h5><?= $category->title; ?></h5>
                    </a>
                </div>

            <?php } ?>


        </div>
    </div>

    <div class="space-area"></div>

</div>
