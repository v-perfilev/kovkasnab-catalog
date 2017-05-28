<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<div class="panel panel-default">

    <div class="panel-heading">

        <div class="row">

            <div class="col-md-8">
                <p class="panel-title">
                    <?= $model->title ?>
                </p>
            </div>

            <div class="col-md-2">
                <p>
                    <?= Yii::$app->formatter->asDatetime($model->created_at) ?>
                </p>
            </div>

            <div class="col-md-2">
                <div class="btn-group pull-right" role="group">
                    <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                        ['/post/view', 'id' => $model->id],
                        [
                            'class' => 'btn btn-primary btn-sm'
                        ]) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                        ['/post/update', 'id' => $model->id],
                        [
                            'class' => 'btn btn-warning btn-sm'
                        ]) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-trash"></span>',
                        ['delete', 'id' => $model->id],
                        [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить эту статью?',
                                'method' => 'post',
                            ],
                        ]) ?>
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

                <div class="col-md-2 col-md-offset-1">
                    <?= Html::img('/uploads/post-images/thumb_' . $model->image_url, ['class'=>'img-responsive'] ) ?>
                </div>
            <?php } else { ?>
                <div class="col-md-12">
                    <?= $model->lead_text ?>
                </div>
            <?php } ?>

    </div>

</div>