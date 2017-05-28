<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>


<a href="<?= Url::to(['view', 'slug' => $model->slug]) ?>" title="Статья - <?= $model->title ?>">
    <div class="item panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h2><?= $model->title ?></h2>
                </div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <?= Yii::$app->formatter->asDatetime($model->created_at, "php:d.m.Y H:i"); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">

                <?php if( isset($model->image_url)) { ?>
                    <div class="col-md-9">
                        <?= $model->lead_text ?>
                    </div>
                    <div class="col-md-3">
                        <?= Html::img('/uploads/post-images/thumb_' . $model->image_url, [
                            'class' => 'img-responsive',
                            'alt' => 'Миниатюра: ' . $product->title,
                            'title' => $product->title
                        ]) ?>
                    </div>
                <?php } else { ?>
                    <div class="col-md-12">
                        <?= $model->lead_text ?>
                    </div>
                <?php } ?>


            </div>
        </div>
    </div>
</a>