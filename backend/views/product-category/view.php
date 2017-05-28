<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы действительно хотите удалить эту категорию?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'title',
        'slug',
        [
            'attribute' => 'image_url',
            'format' => 'html',
            'value' => function($data) {
                if (isset($data->image_url)) return '<img src="/uploads/category-images/thumb_' . $data->image_url . '">';
                else return '';
            },

        ],
        'text:ntext',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ],
]) ?>