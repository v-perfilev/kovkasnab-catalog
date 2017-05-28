<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="gray-area">

    <div class="space-area"></div>

    <div class="random-posts container">

        <h2>Статьи о ковке</h2>

        <div class="row horizontal-center">

            <?php foreach($random_posts as $post) { ?>

                <div class="item col-md-3">
                    <a href="<?= Url::to(['post/view', 'slug' => $post->slug]); ?>" title="Статья - <?= $post->title; ?>">
                        <div class="wrapper">
                            <?php if(isset($post->image_url)) { ?>
                                <?= Html::img('/uploads/post-images/thumb_' . $post->image_url, [
                                    'class' => 'img-responsive',
                                    'alt' => 'Миниатюра: ' . $post->title,
                                    'title' => $post->title
                                ]) ?>
                            <?php } ?>
                            <div class="box horizontal-center vertical-center">
                                <div class="title">
                                    <h4><?= $post->title; ?></h4>
                                </div>
                                <div class="white-circle vertical-center horizontal-center">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            <?php } ?>

        </div>
    </div>

    <div class="space-area"></div>

</div>
