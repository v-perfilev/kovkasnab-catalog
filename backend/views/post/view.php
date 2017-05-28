<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы действительно хотите удалить эту статью?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<div class="row">
    <div class="col-md-4">
        <?= Html::img('/uploads/post-images/thumb_' . $model->image_url, ['class'=>'img-responsive'] ) ?>
    </div>
</div>
<br>
<div class="panel panel-default">
    <div class="panel-body">
        <?= Yii::$app->formatter->asHtml($model->lead_text) ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <?= Yii::$app->formatter->asHtml($model->full_text) ?>
    </div>
</div>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'slug',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ],
]) ?>
