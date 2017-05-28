<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="home-banner parallax" data-parallax="scroll" data-image-src="<?= $image; ?>" data-speed="0.1">
    <div class="container">

        <div class="hidden-xs hidden-sm contacts row">
            <div class="col-md-8">
                <table>
                    <tr>
                        <td>
                            <i class="fa fa-home"></i>
                        </td>
                        <td>
                            г. Тамбов, ул. Урожайная, 1А<br>
                            (металлобаза “ТМС”)
                        </td>
                        <td>
                            <i class="fa fa-calendar"></i>
                        </td>
                        <td>
                            пн–пт &nbsp; &nbsp; 8:00 – 17:00<br>
                            сб &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 8:00 – 12:00
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-envelope"></i>
                        </td>
                        <td>
                            <a href="mailto:info@kovkasnab.ru">info@kovkasnab.ru</a>
                        </td>
                        <td>
                            <i class="fa fa-phone"></i>
                        </td>
                        <td>
                            <b>8-900-510-7777</b>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="home-categories row">

            <?php foreach($categories as $category) { ?>

                <div class="item col-xs-6 col-sm-4 col-md-2">
                    <a href="<?= Url::to(['product/category', 'slug' => $category->slug]); ?>"  title="Категория - <?= $category->title; ?>">
                        <div class="wrapper"></div>
                        <div class="box">
                            <h5 class="vertical-center horizontal-center"><?= $category->title; ?></h5>
                            <?php if(isset($category->image_url)) { ?>
                                <div class="image vertical-center horizontal-center">
                                    <?= Html::img('/uploads/category-images/thumb_' . $category->image_url, [
                                        'class' => 'img-responsive',
                                        'alt' => 'Миниатюра: ' . $category->title,
                                        'title' => $category->title
                                    ]) ?>
                                </div>
                            <?php } ?>
                        </div>
                    </a>
                </div>

            <?php } ?>

        </div>
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
