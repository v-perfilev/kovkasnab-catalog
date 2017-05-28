<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Категории товаров';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php Pjax::begin([ 'timeout' => 3000, 'enablePushState' => false, 'id' => 'product-category-gridview']); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [

        [
            'attribute'=>'id',
            'headerOptions' => ['width' => '50'],
            'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
        ],

        [
            'attribute'=>'title',
            'contentOptions' =>['style'=>'vertical-align:middle;'],
        ],

        [
            'label'=>'Изображение',
            'format'=>'raw',
            'value'=>function($data){
                    if( isset($data->image_url) )
                        return Html::img(Url::to('/uploads/category-images/thumb_' . $data->image_url),['style'=>'width:150px;']);
                    else
                        return "Отсутствует";
            },
            'headerOptions' => ['width' => '200'],
            'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
        ],

        [
            'attribute'=>'order',
            'headerOptions' => ['width' => '150'],
            'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{up-category}&nbsp;&nbsp;&nbsp;&nbsp;{down-category}&nbsp;&nbsp;&nbsp;&nbsp;{view}&nbsp;&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;&nbsp;{delete}',
            'buttons' => [
                'up-category' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>',$url);
                },
                'down-category' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>',$url);
                },
            ],
            'headerOptions' => ['width' => '150'],
            'contentOptions' =>['style'=>'font-size: 20pt; vertical-align:middle;'],
        ],
    ],
]); ?>
<?php Pjax::end(); ?>

